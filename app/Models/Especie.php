<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Especie extends Model
{
    protected $guarded = [];
    protected $appends = ['ruta', 'imagen'];

    protected $casts = [
        'datos' => 'array',
        'contenido' => 'array',
        'caracteristicas' => 'array'
    ];

    public function ecosistema()
    {
        return $this->belongsTo(Ecosistema::class, 'ecosistema_id');
    }

    public function getRutaAttribute()
    {
        return route('especies.show', $this->slug);
    }
    public function getImagenAttribute()
    {
        return Storage::disk('imagenes')->url($this->fotografia);
    }

    protected static function booted()
    {
        // Se ejecuta justo antes de insertar en la base de datos
        static::creating(function ($especie) {
            $especie->slug = Str::slug($especie->nombre);
        });

        // Se ejecuta justo antes de actualizar en la base de datos (opcional)
        static::updating(function ($especie) {
            $especie->slug = Str::slug($especie->nombre);
        });
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
