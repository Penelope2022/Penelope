@extends('layouts.panel')

@section('title', 'Botões')

@section('content')
<h1 class="text-2xl font-bold mb-4">Botões</h1>
@if(session('status'))
    <div class="mb-4 p-2 bg-green-200 text-green-800">{{ session('status') }}</div>
@endif
<form method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block">Rótulo</label>
        <input name="label" class="w-full p-2 border" required>
    </div>
    <div>
        <label class="block">Link</label>
        <input name="link" class="w-full p-2 border" required>
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded">Criar</button>
</form>
<ul class="mt-6 space-y-2">
@foreach($buttons as $button)
    <li class="p-2 border rounded">
        <a class="px-4 py-2 bg-blue-700 text-white rounded" href="{{ $button['link'] }}">{{ $button['label'] }}</a>
    </li>
@endforeach
</ul>
@endsection

