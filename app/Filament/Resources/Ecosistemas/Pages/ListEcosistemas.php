<?php

namespace App\Filament\Resources\Ecosistemas\Pages;

use App\Filament\Resources\Ecosistemas\EcosistemaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEcosistemas extends ListRecords
{
    protected static string $resource = EcosistemaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
