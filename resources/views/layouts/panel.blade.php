<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Painel')</title>
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
    <button id="sidebarToggle" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-blue-700 text-white rounded">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>
    <div class="flex min-h-screen">
        <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-blue-700 text-white p-6 space-y-4 transform -translate-x-full md:translate-x-0 transition-transform duration-300">
            <h2 class="text-2xl font-bold mb-6">Painel</h2>
            <nav class="space-y-2">
                <a href="/panel" class="block px-2 py-1 rounded hover:bg-blue-600">Dashboard</a>
                <a href="/panel/info" class="block px-2 py-1 rounded hover:bg-blue-600">Informações</a>
                <a href="/panel/blog" class="block px-2 py-1 rounded hover:bg-blue-600">Blog</a>
                <a href="/panel/downloads" class="block px-2 py-1 rounded hover:bg-blue-600">Downloads</a>
                <a href="/panel/buttons" class="block px-2 py-1 rounded hover:bg-blue-600">Botões</a>
                <a href="/panel/reports" class="block px-2 py-1 rounded hover:bg-blue-600">Relatórios</a>
            </nav>
            <a href="{{ url('/logout') }}" class="block mt-6 px-2 py-1 rounded bg-blue-800 hover:bg-blue-600 text-center">Sair</a>
        </aside>
        <main class="flex-1 md:ml-64 p-6">
            @yield('content')
        </main>
    </div>
    @vite('resources/js/app.js')
</body>
</html>

