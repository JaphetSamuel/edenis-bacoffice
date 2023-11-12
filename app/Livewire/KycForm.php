<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use App\Enums;
use App\Models\Kyc;
use Livewire\WithFileUploads;
use Saade\FilamentAutograph\Forms\Components\Enums\DownloadableFormat;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;
use function Termwind\style;

class KycForm extends Component implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    public  ?array $data = [];

    public function mount(){
        $this->form->fill();
    }

    public function render()
    {
        return view('modules.KYC.kyc-form');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('User Information')->schema([
                        Forms\Components\TextInput::make('nom')
                            ->extraAttributes(['style' => 'color: black'])
                            ->required(),
                        Forms\Components\TextInput::make('prenom')
                            ->required(),
                        Forms\Components\TextInput::make('adresse'),
                        Forms\Components\TextInput::make('ville')
                            ->required(),
                        Forms\Components\Select::make('pays')->label('Residence Country')
                            ->options(array_map(function($arr){
                                return $arr[3];
                            },Enums\Pays::getPays()))
                            ->required(),
                        Forms\Components\TextInput::make('lieu_naissance')
                            ->required(),
                        Forms\Components\DatePicker::make('date_naissance')
                            ->required(),
                        Forms\Components\Select::make('nationalite')
                            ->options(array_map(function($arr){
                                return $arr[3];},Enums\Pays::getPays()))
                            ->required(),
                        Forms\Components\TextInput::make('profession')
                            ->required(),
                        Forms\Components\TextInput::make('numero_telephone')
                            ->numeric()
                            ->tel()
                            ->required(),

                    ]),
                    Forms\Components\Wizard\Step::make('Documents')->schema([
                        Forms\Components\Select::make('type_piece')
                            ->options([
                                'NATIONAL_CARD' => 'National Identity Card',
                                'Passeport' => 'Passeport',
                                'PERMIT_CONDUIRE' => 'Driving Licence',
                            ])
                            ->required(),
                        Forms\Components\FileUpload::make('piece_identite')
                            ->multiple()
                            ->image()
                            ->required(),

                        Forms\Components\TextInput::make('numero_piece_identite')
                            ->required(),
                        Forms\Components\FileUpload::make('photo')->image()->required(),
                        SignaturePad::make('signature')
                            ->downloadableFormats([DownloadableFormat::PNG])
                            ->backgroundColor('white')
                            ->downloadable()
                            ->filename(function (Kyc $data) {
                                return $data['nom'] . '-' . $data['prenom'] . '-signature.png';
                            })
                    ])->columnSpan('full')
                ])->columnSpan('full'),
            ])
            ->statePath('data');
    }

    public function  create(): void
    {

        $this->validate();
        Kyc::create($this->form->getState());
        $user = auth()->user();
        $user->kyc = true;
        $user->etape = 2;
        $user->save();
        Notification::make()
            ->title('KYC')
            ->body('KYC created successfully')
            ->send();
        $this->redirectRoute('dash');
    }
}
