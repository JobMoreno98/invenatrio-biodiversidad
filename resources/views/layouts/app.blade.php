<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @stack('css')
</head>

<body class="bg-light text-dark">

    <!-- NAVBAR -->

    <nav class="w-full z-50 bg-white">
        <div class="glass border-b border-white/40">

            <div class="max-w-7xl mx-auto px-6">

                <div class="flex justify-start items-center h-20">

                    <h1 class="text-2xl font-extrabold text-primary">
                        {{ config('app.name', 'Laravel') }}
                    </h1>

                    <div class="mx-3 hidden md:flex gap-10 text-gray-700">

                        <a href="{{ route('home') }}" class="hover:text-primary">Inicio</a><!--
                        <a href="{{ route('especies.index') }}" class="hover:text-primary">Especies</a>
                        
                        <a href="#" class="hover:text-primary">Fauna</a>
    -->

                    </div>
                </div>

            </div>

        </div>
    </nav>

    <div class="my-auto flex flex-col">
        @yield('content')

    </div>

    <!-- FOOTER -->

    <footer class="bg-dark text-gray-300">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid md:grid-cols-3 gap-10">
                <div>
                    <h2 class="text-3xl font-black text-white">
                        {{ config('app.name', 'Laravel') }}
                    </h2>
                    <p class="mt-5">
                        Una plataforma para explorar y aprender sobre la biodiversidad en CUCSH.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-5">
                        Categorías
                    </h4>
                    <ul class="space-y-3">
                        <li>Flora</li>
                        <li>Fauna</li>
                        <li>Ecosistemas</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-5">
                        Contacto
                    </h4>
                    <p>info@.com</p>
                </div>
            </div>
        </div>
    </footer>
    @livewireScripts
    @stack('js')
</body>

</html>
