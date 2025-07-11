@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto p-4">
    <a href="{{ route('admin.plugins.create') }}" class="bg-blue-500 text-white px-4 py-2">Novo Plugin</a>
    <table class="min-w-full mt-4 border">
        <thead>
            <tr>
                <th class="border px-2">ID</th>
                <th class="border px-2">Nome</th>
                <th class="border px-2">Versão</th>
                <th class="border px-2">Ativo</th>
                <th class="border px-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $plugin)
            <tr>
                <td class="border px-2">{{ $plugin->id }}</td>
                <td class="border px-2">{{ $plugin->name }}</td>
                <td class="border px-2">{{ $plugin->version }}</td>
                <td class="border px-2">{{ $plugin->enabled ? 'Sim' : 'Não' }}</td>
                <td class="border px-2 space-x-2">
                    <form method="POST" action="{{ route('admin.plugins.toggle', $plugin) }}" class="inline">
                        @csrf
                        <button class="text-blue-500">Alternar</button>
                    </form>
                    <form method="POST" action="{{ route('admin.plugins.destroy', $plugin) }}" class="inline" onsubmit="return confirm('Remover plugin?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
