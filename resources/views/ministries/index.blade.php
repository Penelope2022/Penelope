@extends('layouts.app')

@section('title', 'Ministérios')

@section('content')
<section class="py-12" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-semibold mb-6">Ministérios</h1>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($ministries as $ministry)
                <div class="p-6 border rounded shadow-sm">
                    <h2 class="text-xl font-bold mb-2">{{ $ministry['name'] }}</h2>
                    <p>{{ $ministry['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
