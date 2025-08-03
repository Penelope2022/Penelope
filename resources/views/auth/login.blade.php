@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 py-12">
    <div class="bg-white dark:bg-gray-800 p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl mb-6 font-bold text-center">Acesso ao Painel</h2>
        @if($errors->any())
            <div class="mb-4 text-red-600">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ url('/login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-3 py-2 border rounded" />
            </div>
            <div>
                <label for="password" class="block mb-1">Senha</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border rounded" />
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Entrar</button>
        </form>
    </div>
</div>
@endsection

