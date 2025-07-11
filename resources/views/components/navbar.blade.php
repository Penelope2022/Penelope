<nav class="bg-white shadow mb-4">
    <div class="container mx-auto px-4 py-2 flex justify-between items-center">
        <div>
            <a href="/" class="font-semibold text-gray-700">{{ config('app.name', 'Penelope') }}</a>
        </div>
        <div class="space-x-4">
            <a href="/" class="navbar-link">Home</a>
            @auth
                <a href="{{ route('dashboard') }}" class="navbar-link">Dashboard</a>
                <form class="inline" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="navbar-link">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="navbar-link">Login</a>
                <a href="{{ route('register') }}" class="navbar-link">Registrar</a>
            @endauth
        </div>
    </div>
</nav>
