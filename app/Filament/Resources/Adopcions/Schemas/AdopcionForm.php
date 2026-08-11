<?php

namespace App\Filament\Resources\Adopcions\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AdopcionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('foto')->columnSpanFull()->image(),
                TextInput::make('adoptante')->nullable(),
                Select::make('especie_id')->relationship('especie','nombre')->required(),
                TinyEditor::make('contenido')->profile('default')->columnSpanFull(),
            ]);
    }
}
