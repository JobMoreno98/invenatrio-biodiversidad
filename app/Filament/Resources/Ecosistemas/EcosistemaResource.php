<?php

namespace App\Filament\Resources\Ecosistemas;

use App\Filament\Resources\Ecosistemas\Pages\CreateEcosistema;
use App\Filament\Resources\Ecosistemas\Pages\EditEcosistema;
use App\Filament\Resources\Ecosistemas\Pages\ListEcosistemas;
use App\Filament\Resources\Ecosistemas\Schemas\EcosistemaForm;
use App\Filament\Resources\Ecosistemas\Tables\EcosistemasTable;
use App\Models\Ecosistema;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EcosistemaResource extends Resource
{
    protected static ?string $model = Ecosistema::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Ecosistema';

    public static function form(Schema $schema): Schema
    {
        return EcosistemaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EcosistemasTable::configure($table);
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
            'index' => ListEcosistemas::route('/'),
            'create' => CreateEcosistema::route('/create'),
            'edit' => EditEcosistema::route('/{record}/edit'),
        ];
    }
}
