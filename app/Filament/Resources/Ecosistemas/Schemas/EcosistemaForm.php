<?php

namespace App\Filament\Resources\Ecosistemas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EcosistemaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')->required()
            ]);
    }
}
