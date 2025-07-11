@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <p>Usuário logado: {{ auth()->user()->name }}</p>
    <div class="mt-4 space-x-4">
        <a href="{{ route('admin.clients.index') }}" class="text-blue-500">Gerenciar Clientes</a>
        <a href="{{ route('admin.plugins.index') }}" class="text-blue-500">Gerenciar Plugins</a>
    </div>
@endsection
