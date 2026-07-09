<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $especies = Especie::with('ecosistema')->get();
        return view('home', compact('especies'));
    }
}
