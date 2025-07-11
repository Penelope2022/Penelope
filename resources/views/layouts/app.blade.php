<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Penelope') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-gradient-to-r from-purple-600 to-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="font-bold text-lg">{{ config('app.name', 'Penelope') }}</h1>
            <nav>
                <a href="/" class="mr-4 hover:underline">Home</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="mr-4 hover:underline">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="hover:underline">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-4 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="hover:underline">Registrar</a>
                @endauth
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-4">
        @include('components.flash')
        @yield('content')
    </main>
</body>
</html>
