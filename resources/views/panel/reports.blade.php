@extends('layouts.panel')

@section('title', 'Relatórios')

@section('content')
<h1 class="text-2xl font-bold mb-4">Relatórios</h1>
<table class="w-full text-left border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 border">Categoria</th>
            <th class="p-2 border">Quantidade</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="p-2 border">Informações</td>
            <td class="p-2 border">{{ $summary['infos'] }}</td>
        </tr>
        <tr>
            <td class="p-2 border">Posts</td>
            <td class="p-2 border">{{ $summary['posts'] }}</td>
        </tr>
        <tr>
            <td class="p-2 border">Arquivos</td>
            <td class="p-2 border">{{ $summary['files'] }}</td>
        </tr>
        <tr>
            <td class="p-2 border">Botões</td>
            <td class="p-2 border">{{ $summary['buttons'] }}</td>
        </tr>
    </tbody>
</table>
@endsection

