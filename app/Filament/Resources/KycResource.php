<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KycResource\Pages;
use App\Filament\Resources\KycResource\RelationManagers;
use App\Enums;
use App\Models\Kyc;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;

class KycResource extends Resource
{
    protected static ?string $model = Kyc::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('User Information')->schema([
                        Forms\Components\TextInput::make('nom')
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
                            ->required(),
                        Forms\Components\TextInput::make('numero_piece_identite')
                            ->required(),
                        Forms\Components\FileUpload::make('photo')
                            ->required(),
                        SignaturePad::make('signature')
                            ->required(),
                    ])
                ])->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('adresse')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ville')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pays')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lieu_naissance')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_naissance')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nationalite')
                    ->searchable(),
                Tables\Columns\TextColumn::make('profession')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_piece')
                    ->searchable(),
                Tables\Columns\TextColumn::make('piece_identite')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_piece_identite')
                    ->searchable(),
                Tables\Columns\TextColumn::make('photo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('signature')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_telephone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKycs::route('/'),
            'create' => Pages\CreateKyc::route('/create'),
            'view' => Pages\ViewKyc::route('/{record}'),
            'edit' => Pages\EditKyc::route('/{record}/edit'),
        ];
    }
}
