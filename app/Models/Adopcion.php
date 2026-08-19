<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;

class Adopcion extends Model
{
    protected $guarded = [];

    public function especie()
    {
        return $this->belongsTo(Especie::class, 'especie_id');
    }

    protected function contenido(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Purifier::clean($value),
        );
    }

    protected function imagenUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->foto
                ? Storage::disk('imagenes')->url($this->foto)
                : null, // o una imagen por defecto: asset('images/default.jpg')
        );
    }

    public function getRouteKeyName(): string
    {
        return 'folio';
    }
}
