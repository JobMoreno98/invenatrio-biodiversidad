<?php

namespace App\Filament\Resources\Ecosistemas\Pages;

use App\Filament\Resources\Ecosistemas\EcosistemaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEcosistema extends EditRecord
{
    protected static string $resource = EcosistemaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
