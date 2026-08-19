@php
    $title = 'ADOPCIONES';
@endphp
@extends('layouts.app')
@push('css')
    <style>
        body {
            font-family: Manrope, sans-serif;
        }

        .glass {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, .75);
        }

        .hero {
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, .40), rgba(0, 0, 0, .40)),
                url("{{ asset('img/adopcion.jpeg') }}");
            background-size: cover;
            background-position: top;
            background-position: center 35%;
        }

        .card:hover img {
            transform: scale(1.08);
        }

        img {
            transition: .5s;
        }

        .badge-disponible {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-adoptado {
            background: #f3f4f6;
            color: #6b7280;
        }
    </style>
@endpush
@section('content')
    <!-- HERO -->
    <section class="hero flex items-center" style="height: 55vh">
        <div class="max-w-7xl mx-auto px-8 w-full">
            <h1 class="text-6xl font-black text-white text-center">
                Adopta un árbol
            </h1>
            <p>
            <h1 class="uppercase text-center text-2xl font-black text-white text-center border-t-4 border-white pt-1 mt-1">
                se parte de nuestro ecosistema CUCSH
            </h1>
            </p>
        </div>
    </section>

    <!-- BUSCADOR + LISTADO (Livewire, server-side, paginado) -->
    <section class="mt-14 relative z-20">
        <div class="max-w-7xl mx-auto px-6">
            <livewire:arboles-index />
        </div>
    </section>
@endsection
