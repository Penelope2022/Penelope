@extends('layouts.app')

@section('content')
<div class="flex">
    <aside class="w-48 mr-6">
        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block text-blue-700">Dashboard</a>
            <a href="{{ route('admin.clients.index') }}" class="block text-blue-700">Clientes</a>
            <a href="{{ route('admin.plugins.index') }}" class="block text-blue-700">Plugins</a>
        </nav>
    </aside>
    <div class="flex-1">
        @yield('admin-content')
    </div>
</div>
@endsection
