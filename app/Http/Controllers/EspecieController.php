<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    public function index()
    {
        $especies = Especie::with('ecosistema')->get();
        return view('especies.index', compact('especies'));
    }
    public function show($especie)
    {
        $especie = Especie::where('slug',$especie)->first();
        if(!$especie){
            abort(404);
        }
        //dd($especie);
        return view('especies.show', compact('especie'));
    }
}
