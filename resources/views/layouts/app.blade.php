<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Igreja Adventista') }}</title>
    <meta name="description" content="Igreja Adventista do Sétimo Dia - Site institucional" />
    @vite('resources/css/app.css')
    @stack('head')
</head>
<body class="antialiased bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    @include('partials.header')
    <main>
        @yield('content')
    </main>
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
