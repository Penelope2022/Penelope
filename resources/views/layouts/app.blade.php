<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Igreja Adventista'))</title>
    <meta name="description" content="@yield('description', 'Igreja Adventista do Sétimo Dia - Site institucional')" />
    <meta property="og:title" content="@yield('og_title', config('app.name', 'Igreja Adventista'))" />
    <meta property="og:description" content="@yield('og_description', 'Igreja Adventista do Sétimo Dia - Site institucional')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    @vite('resources/css/app.css')
    @stack('head')
</head>
<body class="antialiased bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    @include('partials.header')
    @include('partials.social')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
    <a href="https://wa.me/5599999999999" target="_blank" aria-label="WhatsApp" class="fixed bottom-4 right-4 bg-green-500 text-white p-3 rounded-full shadow-lg hover:bg-green-600"><i class="fab fa-whatsapp text-2xl"></i></a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fslightbox/index.js"></script>
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
