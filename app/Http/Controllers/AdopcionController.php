<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Especie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdopcionController extends Controller
{
    public function index()
    {
        return view('adopciones.index');
    }

    /**
     * Certificado / detalle público de una adopción, buscado por folio.
     */
    public function show(string $folio)
    {
        $adopcion = Adopcion::with('especie')
            ->where('folio', $folio)
            ->firstOrFail();

        return view('adopciones.show', compact('adopcion'));
    }
}
