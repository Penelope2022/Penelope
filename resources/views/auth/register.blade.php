@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ url('register') }}" class="max-w-sm mx-auto">
        @csrf
        <div class="mb-2">
            <label>Nome</label>
            <input class="border p-2 w-full" type="text" name="name" required />
        </div>
        <div class="mb-2">
            <label>Email</label>
            <input class="border p-2 w-full" type="email" name="email" required />
        </div>
        <div class="mb-2">
            <label>Senha</label>
            <input class="border p-2 w-full" type="password" name="password" required />
        </div>
        <div class="mb-2">
            <label>Confirme a Senha</label>
            <input class="border p-2 w-full" type="password" name="password_confirmation" required />
        </div>
        <div class="mb-2">
            <label>Papel</label>
            <select name="role" class="border p-2 w-full">
                <option value="admin">Admin</option>
                <option value="manager">Gerente</option>
                <option value="operator">Operador</option>
            </select>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 mt-4">Registrar</button>
    </form>
@endsection
