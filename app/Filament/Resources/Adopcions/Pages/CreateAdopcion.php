<?php

namespace App\Filament\Resources\Adopcions\Pages;

use App\Filament\Resources\Adopcions\AdopcionResource;
use App\Models\Adopcion;
use App\Models\Especie;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateAdopcion extends CreateRecord
{
    protected static string $resource = AdopcionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // 1. Buscamos la especie usando el ID que viene del formulario
        $especie = Especie::find($data['especie_id']);

if ($especie) {
        $prefijo = strtoupper(substr($especie->nombre, 0, 3));

        // 1. Buscamos solo registros que tengan la misma especie y un folio con este prefijo
        $ultimoFolio = Adopcion::where('especie_id', $especie->id)
            ->where('folio', 'LIKE', "{$prefijo}-%")
            ->pluck('folio')
            ->map(function ($folio) {
                // Extraemos únicamente la parte numérica final
                $partes = explode('-', $folio);
                return (int) end($partes);
            })
            ->max(); // Obtenemos el número más alto para esta especie

        // 2. Si no hay ninguno previa, iniciamos en 1; de lo contrario incrementamos +1
        $siguienteNumero = $ultimoFolio ? ($ultimoFolio + 1) : 1;

        // 3. Formateamos a 3 dígitos (ej: PER-001)
        $codigo = str_pad($siguienteNumero, 3, '0', STR_PAD_LEFT);

        $data['folio'] = "{$prefijo}-{$codigo}";
    }

        // Retornamos el arreglo de datos modificado
        return $data;
    }
}
