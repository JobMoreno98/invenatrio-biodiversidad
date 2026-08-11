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
            // 1. Obtenemos el prefijo (3 primeras letras de la especie)
            $prefijo = strtoupper(substr($especie->nombre, 0, 3));

            // 2. Buscamos la última adopción registrada de esta misma especie
            $ultimaAdopcion = Adopcion::where('especie_id', $especie->id)
                ->latest('id') // Ordenamos por el ID más reciente
                ->first();

            $siguienteNumero = 1; // Por defecto empezamos en 1

            if ($ultimaAdopcion && $ultimaAdopcion->folio) {
                // Si ya existe una, separamos el prefijo del número (ej: PER-005)
                $partes = explode('-', $ultimaAdopcion->folio);

                // Tomamos la última parte (005), la convertimos a entero y le sumamos 1
                $ultimoNumero = (int) end($partes);
                $siguienteNumero = $ultimoNumero + 1;
            }

            // 3. Formateamos el número para que tenga 3 dígitos con ceros a la izquierda (001, 002, 015, etc.)
            // Puedes cambiar el '3' por el número de dígitos que prefieras
            $codigo = str_pad($siguienteNumero, 3, '0', STR_PAD_LEFT);

            // 4. Asignamos el folio final
            $data['folio'] = "{$prefijo}-{$codigo}";
        }

        // Retornamos el arreglo de datos modificado
        return $data;
    }
}
