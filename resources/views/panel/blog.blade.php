@extends('layouts.panel')

@section('title', 'Blog')

@section('content')
<h1 class="text-2xl font-bold mb-4">Blog</h1>
@if(session('status'))
    <div class="mb-4 p-2 bg-green-200 text-green-800">{{ session('status') }}</div>
@endif
<form method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block">Título</label>
        <input name="title" class="w-full p-2 border" required>
    </div>
    <div>
        <label class="block">Conteúdo</label>
        <textarea name="content" class="w-full p-2 border" required></textarea>
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded">Publicar</button>
</form>
<ul class="mt-6 space-y-2">
@foreach($posts as $post)
    <li class="p-2 border rounded">
        <h3 class="font-semibold">{{ $post['title'] }}</h3>
        <p>{{ $post['content'] }}</p>
    </li>
@endforeach
</ul>
@endsection

