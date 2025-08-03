@extends('layouts.panel')

@section('title', 'Downloads')

@section('content')
<h1 class="text-2xl font-bold mb-4">Downloads</h1>
@if(session('status'))
    <div class="mb-4 p-2 bg-green-200 text-green-800">{{ session('status') }}</div>
@endif
<form method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block">Nome</label>
        <input name="name" class="w-full p-2 border" required>
    </div>
    <div>
        <label class="block">URL</label>
        <input name="url" class="w-full p-2 border" required>
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded">Adicionar</button>
</form>
<ul class="mt-6 space-y-2">
@foreach($files as $file)
    <li class="p-2 border rounded">
        <a class="text-blue-700" href="{{ $file['url'] }}">{{ $file['name'] }}</a>
    </li>
@endforeach
</ul>
@endsection

