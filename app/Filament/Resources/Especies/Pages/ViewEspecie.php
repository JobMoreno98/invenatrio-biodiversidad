<?php

namespace App\Filament\Resources\Especies\Pages;

use App\Filament\Resources\Especies\EspecieResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEspecie extends ViewRecord
{
    protected static string $resource = EspecieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
