@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto p-4">
    <form method="POST" action="{{ route('admin.clients.update', $client) }}" class="max-w-md">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label>Nome</label>
            <input type="text" name="name" class="border p-2 w-full" value="{{ $client->name }}" required>
        </div>
        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" class="border p-2 w-full" value="{{ $client->email }}">
        </div>
        <div class="mb-2">
            <label>Telefone</label>
            <input type="text" name="phone" class="border p-2 w-full" value="{{ $client->phone }}">
        </div>
        <div class="mb-2">
            <label>Endereço</label>
            <input type="text" name="address" class="border p-2 w-full" value="{{ $client->address }}">
        </div>
        <button class="bg-blue-500 text-white px-4 py-2">Salvar</button>
    </form>
</div>
@endsection
