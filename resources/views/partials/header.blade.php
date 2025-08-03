<header class="sticky top-0 z-50 bg-white/70 backdrop-blur dark:bg-gray-800/70">
    <div class="container mx-auto flex justify-between items-center p-4">
        <a href="/" class="text-xl font-bold">{{ config('app.name', 'Igreja Adventista') }}</a>
        <nav class="hidden md:flex space-x-4 items-center">
            <a href="#sobre" class="hover:text-blue-600">Sobre</a>
            <div class="relative group">
                <a href="#ministerios" class="hover:text-blue-600 inline-block">Ministérios</a>
                <div class="absolute left-0 mt-2 hidden group-hover:block bg-white dark:bg-gray-800 shadow-lg p-4 space-y-2">
                    <a href="#ministerios" class="block whitespace-nowrap">Jovens</a>
                    <a href="#ministerios" class="block whitespace-nowrap">Música</a>
                    <a href="#ministerios" class="block whitespace-nowrap">Aventureiros</a>
                </div>
            </div>
            <a href="#noticias" class="hover:text-blue-600">Notícias</a>
            <a href="#eventos" class="hover:text-blue-600">Eventos</a>
            <a href="#programacao" class="hover:text-blue-600">Programação</a>
            <a href="#doacoes" class="hover:text-blue-600">Doações</a>
            <a href="#contato" class="hover:text-blue-600">Contato</a>
        </nav>
        <div class="flex items-center space-x-4">
            <button id="themeToggle" class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                <svg id="themeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-9h-1M4.34 12h-1m14.14 7.07l-.7-.7M6.22 6.22l-.7-.7m12.02 12.95l-.7.7M6.22 17.78l-.7.7M12 5a7 7 0 100 14a7 7 0 000-14z"></path></svg>
            </button>
            <a href="#doar" class="bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-700">Doar</a>
            <button id="menuToggle" class="md:hidden p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>
    <div id="mobileMenu" class="md:hidden hidden flex-col space-y-2 px-4 pb-4">
        <a href="#sobre" class="block">Sobre</a>
        <a href="#ministerios" class="block">Ministérios</a>
        <a href="#noticias" class="block">Notícias</a>
        <a href="#eventos" class="block">Eventos</a>
        <a href="#programacao" class="block">Programação</a>
        <a href="#doacoes" class="block">Doações</a>
        <a href="#contato" class="block">Contato</a>
    </div>
</header>
