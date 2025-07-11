@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto p-4">
    <a href="{{ route('admin.clients.create') }}" class="bg-blue-500 text-white px-4 py-2">Novo Cliente</a>
    <table class="min-w-full mt-4 border">
        <thead>
            <tr>
                <th class="border px-2">ID</th>
                <th class="border px-2">Nome</th>
                <th class="border px-2">Email</th>
                <th class="border px-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $client)
            <tr>
                <td class="border px-2">{{ $client->id }}</td>
                <td class="border px-2">{{ $client->name }}</td>
                <td class="border px-2">{{ $client->email }}</td>
                <td class="border px-2">
                    <a class="text-blue-500" href="{{ route('admin.clients.edit', $client) }}">Editar</a>
                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" onclick="return confirm('Remover?')">Remover</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
