@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto p-4">
    <form method="POST" action="{{ route('admin.plugins.store') }}" enctype="multipart/form-data" class="max-w-md">
        @csrf
        <div class="mb-2">
            <label>Nome</label>
            <input type="text" name="name" class="border p-2 w-full" required>
        </div>
        <div class="mb-2">
            <label>Versão</label>
            <input type="text" name="version" class="border p-2 w-full">
        </div>
        <div class="mb-2">
            <label>Arquivo do Plugin (.zip)</label>
            <input type="file" name="file" class="border p-2 w-full" required>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2">Salvar</button>
    </form>
</div>
@endsection
