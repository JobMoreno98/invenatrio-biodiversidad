@php
    $title = 'ESPECIES';
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
                linear-gradient(to right, rgba(0, 0, 0, .55), rgba(0, 0, 0, .15)),
                url("https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1800&q=80");
            background-size: cover;
            background-position: center;
        }

        .card:hover img {
            transform: scale(1.08);
        }

        img {
            transition: .5s;
        }
    </style>
@endpush
@section('content')
    <!-- BUSCADOR + FILTROS -->

    <section class="mt-14 relative z-20">

        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-xl p-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-0 gap-y-1 md:gap-5">


                    <input id="searchInput" type="text" placeholder="Buscar especie..."
                        class="col-span-2 border rounded-md md:rounded-xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-primary">

                    <button class="bg-primary rounded-md md:rounded-xl text-white w-full">
                        Buscar
                    </button>

                </div>
                {{-- 
                    <div class="flex flex-wrap gap-3 mt-6">

                        <button data-filter="todas"
                            class="filter-btn active border border-primary text-primary px-5 py-2 rounded-full font-medium transition">
                            Todas
                        </button>
                        <button data-filter="Flora"
                            class="filter-btn border border-primary text-primary px-5 py-2 rounded-full font-medium transition">
                            🌿 Flora
                        </button>
                        <button data-filter="Aves"
                            class="filter-btn border border-primary text-primary px-5 py-2 rounded-full font-medium transition">
                            🦜 Aves
                        </button>
                        <button data-filter="Mamíferos"
                            class="filter-btn border border-primary text-primary px-5 py-2 rounded-full font-medium transition">
                            🦊 Mamíferos
                        </button>
                        <button data-filter="Insectos"
                            class="filter-btn border border-primary text-primary px-5 py-2 rounded-full font-medium transition">
                            🦋 Insectos
                        </button>

                    </div>
     --}}
            </div>

        </div>

    </section>

    <!-- ESPECIES -->

    <section class="py-24">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center mb-10">

                <h2 class="text-4xl font-extrabold">
                    Especies registradas
                </h2>

                <p id="counter" class="text-gray-500 font-medium"></p>

            </div>

            <div id="grid" class="grid md:grid-cols-3 gap-10">

                <!-- Las tarjetas se generan con JS a partir del arreglo "especies" -->

            </div>

            <p id="empty" class="hidden text-center text-gray-400 py-20">
                No se encontraron especies con ese criterio.
            </p>

        </div>

    </section>
@endsection
@push('js')
    <script>
        // Fuente única de datos: agrega o edita especies aquí y se reflejan en toda la página.
        const especies = @json($especies);

        const grid = document.getElementById("grid");
        const counter = document.getElementById("counter");
        const empty = document.getElementById("empty");
        const searchInput = document.getElementById("searchInput");
        let filtroActivo = "todas";

        function limitText(html, limit = 130) {
            const text = html.replace(/<[^>]*>/g, '');
            return text.length > limit ? text.slice(0, limit) + '...' : text;
        }

        function crearTarjeta(especie) {
            console.log(especie)
            return `
                <div class="card bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition">
                    <div class="overflow-hidden">
                        <img class="h-72 w-full object-cover" src="${especie.imagen}">
                    </div>
                    <div class="p-7">
                        <div class="flex justify-between items-center">
                            <span class="bg-green-100 text-green-700 px-2 md:px-3 py-1  rounded-lg text-sm">
                                ${especie.cientifico}
                            </span>
                            <span class="${especie.estadoColor}  text-gray-500 font-semibold">
                                ${especie.datos[0]['valor']}
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold mt-5">
                            ${especie.nombre}
                        </h3>
                        <p class="italic text-gray-500">
                            ${especie.cientifico}
                        </p>
                        <p class="mt-5 text-gray-600 leading-relaxed">
                            ${limitText(especie.contenido[0].contenido, 130)}
                        </p>
                        
                        <a href="${especie.ruta}" class="mt-8 text-primary font-bold">
                            Leer más →
                        </a>
                    </div>
                </div>
            `;
        }

        function render() {
            const termino = searchInput.value.trim().toLowerCase();

            const filtradas = especies.filter(e => {
                const coincideCategoria = filtroActivo === "todas" || e.categoria === filtroActivo;
                const coincideBusqueda = e.nombre.toLowerCase().includes(termino) ||
                    e.cientifico.toLowerCase().includes(termino);
                return coincideCategoria && coincideBusqueda;
            });

            grid.innerHTML = filtradas.map(crearTarjeta).join("");
            counter.textContent = filtradas.length + (filtradas.length === 1 ? " especie" : " especies");
            empty.classList.toggle("hidden", filtradas.length !== 0);
            grid.classList.toggle("hidden", filtradas.length === 0);
        }

        document.querySelectorAll(".filter-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                filtroActivo = btn.dataset.filter;
                render();
            });
        });

        searchInput.addEventListener("input", render);

        render();
    </script>
@endpush
