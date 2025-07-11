@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ url('login') }}" class="max-w-sm mx-auto">
        @csrf
        <div class="mb-2">
            <label>Email</label>
            <input class="border p-2 w-full" type="email" name="email" required />
        </div>
        <div class="mb-2">
            <label>Senha</label>
            <input class="border p-2 w-full" type="password" name="password" required />
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 mt-4">Entrar</button>
    </form>
@endsection
