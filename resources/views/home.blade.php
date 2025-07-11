@extends('layouts.app')

@section('content')
<section class="relative flex items-center justify-center h-screen bg-cover bg-center" style="background-image: url('/images/hero.jpg')" data-aos="fade-in">
    <div class="text-center bg-white/70 dark:bg-gray-800/70 p-6 rounded">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Bem-vindo à nossa Igreja</h1>
        <p class="text-lg md:text-2xl">"Ide por todo o mundo e pregai o evangelho"</p>
    </div>
</section>

<section id="sermoes" class="py-12" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Últimos Sermões</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <iframe class="w-full h-60" src="https://www.youtube.com/embed/videoid" title="Sermão" allowfullscreen></iframe>
            <iframe class="w-full h-60" src="https://www.youtube.com/embed/videoid" title="Sermão" allowfullscreen></iframe>
            <iframe class="w-full h-60" src="https://www.youtube.com/embed/videoid" title="Sermão" allowfullscreen></iframe>
        </div>
    </div>
</section>

<section id="eventos" class="py-12 bg-gray-100 dark:bg-gray-800" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Próximos Eventos</h2>
        <div id="calendar"></div>
    </div>
</section>

<section id="contato" class="py-12" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Fale Conosco</h2>
        <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block">Nome</label>
                <input type="text" name="name" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block">Mensagem</label>
                <textarea name="message" class="w-full p-2 border rounded" required></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enviar</button>
        </form>
    </div>
</section>
@endsection
