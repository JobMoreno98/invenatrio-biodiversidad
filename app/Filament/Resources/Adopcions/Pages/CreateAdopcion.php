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
        $especie = Especie::find($data['especie_id'] ?? null);

        if ($especie && $especie->slug) {
            // Convertimos el slug a mayúsculas (ej: "perro-mestizo" -> "PERRO-MESTIZO")
            $prefijo = strtoupper($especie->slug);

            // Buscamos el último consecutivo usando el slug como prefijo
            $ultimoFolio = Adopcion::where('especie_id', $especie->id)
                ->where('folio', 'LIKE', "{$prefijo}-%")
                ->pluck('folio')
                ->map(function ($folio) {
                    $partes = explode('-', $folio);
                    return (int) end($partes);
                })
                ->max();

            $siguienteNumero = $ultimoFolio ? ($ultimoFolio + 1) : 1;
            $codigo = str_pad($siguienteNumero, 3, '0', STR_PAD_LEFT);

            // Resultado ej: PERRO-001 o PERRO-MESTIZO-001
            $data['folio'] = "{$prefijo}-{$codigo}";
        }

        return $data;
    }
}
