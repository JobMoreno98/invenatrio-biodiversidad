<?php

namespace App\Filament\Resources\Adopcions;

use App\Filament\Resources\Adopcions\Pages\CreateAdopcion;
use App\Filament\Resources\Adopcions\Pages\EditAdopcion;
use App\Filament\Resources\Adopcions\Pages\ListAdopcions;
use App\Filament\Resources\Adopcions\Pages\ViewAdopcion;
use App\Filament\Resources\Adopcions\Schemas\AdopcionForm;
use App\Filament\Resources\Adopcions\Schemas\AdopcionInfolist;
use App\Filament\Resources\Adopcions\Tables\AdopcionsTable;
use App\Models\Adopcion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdopcionResource extends Resource
{
    protected static ?string $model = Adopcion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Adoptar';

    protected static ?string $title = 'Registros y adopciones';

    protected static ?string $navigationLabel = 'Registros y adopciones';
    
    protected static ?string $navigationList = 'Registros y adopciones';

    protected static ?string $pluralModelLabel = 'Registros y adopciones';


    protected static ?string $slug = 'registros-y-adopciones';

    public static function form(Schema $schema): Schema
    {
        return AdopcionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AdopcionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdopcionsTable::configure($table);
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
            'index' => ListAdopcions::route('/'),
            'create' => CreateAdopcion::route('/create'),
            'view' => ViewAdopcion::route('/{record}'),
            'edit' => EditAdopcion::route('/{record}/edit'),
        ];
    }
}
