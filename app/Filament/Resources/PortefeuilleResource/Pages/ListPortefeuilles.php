<?php

namespace App\Filament\Resources\PortefeuilleResource\Pages;

use App\Filament\Resources\PortefeuilleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortefeuilles extends ListRecords
{
    protected static string $resource = PortefeuilleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
