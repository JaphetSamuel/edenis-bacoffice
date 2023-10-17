<?php

namespace App\Filament\Resources\PortefeuilleResource\Pages;

use App\Filament\Resources\PortefeuilleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortefeuille extends EditRecord
{
    protected static string $resource = PortefeuilleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
