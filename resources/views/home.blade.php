@extends('layouts.app')

@section('content')
<section class="relative flex items-center justify-center h-screen bg-cover bg-center" style="background-image: url('/images/hero.jpg')" data-aos="fade-in">
    <div class="text-center bg-white/70 dark:bg-gray-800/70 p-6 rounded">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Bem-vindo à nossa Igreja</h1>
        <p class="text-lg md:text-2xl">"Ide por todo o mundo e pregai o evangelho"</p>
    </div>
</section>

<section id="sobre" class="py-12" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Seja Bem-vindo</h2>
        <p class="max-w-3xl">Estamos felizes em tê-lo conosco. Nossa missão é compartilhar o amor de Cristo e servir nossa comunidade.</p>
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

<section id="programacao" class="py-12 bg-gray-100 dark:bg-gray-800" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Programação Semanal</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <div class="p-4 border rounded"><h3 class="font-bold mb-2">Segunda</h3><p>19:30 Estudo Bíblico</p></div>
            <div class="p-4 border rounded"><h3 class="font-bold mb-2">Quarta</h3><p>20:00 Culto de Oração</p></div>
            <div class="p-4 border rounded"><h3 class="font-bold mb-2">Sábado</h3><p>09:00 Escola Sabatina</p></div>
            <div class="p-4 border rounded"><h3 class="font-bold mb-2">Domingo</h3><p>18:00 Culto Jovem</p></div>
        </div>
    </div>
</section>

<section id="ministerios" class="py-12" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Destaques dos Ministérios</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="p-4 border rounded"><h3 class="font-bold mb-2">Jovens</h3><p>Atividades inspiradoras para a juventude.</p></div>
            <div class="p-4 border rounded"><h3 class="font-bold mb-2">Escola Sabatina</h3><p>Estudos em classes para todas as idades.</p></div>
            <div class="p-4 border rounded"><h3 class="font-bold mb-2">Música</h3><p>Louvor e adoração através da música.</p></div>
        </div>
        <div class="text-center mt-6"><a href="{{ route('ministries.index') }}" class="underline">Ver todos os ministérios</a></div>
    </div>
</section>

<section id="noticias" class="py-12 bg-gray-100 dark:bg-gray-800" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Últimas Notícias</h2>
        <div class="space-y-4">
            <article class="p-4 border rounded"><h3 class="text-xl font-bold">Lançamento do novo curso bíblico</h3><p class="text-gray-600">Inscreva-se para aprofundar seu estudo da Bíblia.</p></article>
            <article class="p-4 border rounded"><h3 class="text-xl font-bold">Mutirão de Natal</h3><p class="text-gray-600">Participe dessa corrente de solidariedade.</p></article>
        </div>
    </div>
</section>

<section id="eventos" class="py-12" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Próximos Eventos</h2>
        <div id="calendar"></div>
        <div class="text-center mt-6"><a href="{{ route('events.index') }}" class="underline">Ver agenda completa</a></div>
    </div>
</section>

<section id="galeria" class="py-12 bg-gray-100 dark:bg-gray-800" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Galeria</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="https://source.unsplash.com/random/800x600?church" data-fslightbox="galeria"><img src="https://source.unsplash.com/random/400x300?church&1" class="object-cover w-full h-32" alt=""></a>
            <a href="https://source.unsplash.com/random/800x601?bible" data-fslightbox="galeria"><img src="https://source.unsplash.com/random/400x300?bible&2" class="object-cover w-full h-32" alt=""></a>
            <a href="https://source.unsplash.com/random/800x602?community" data-fslightbox="galeria"><img src="https://source.unsplash.com/random/400x300?community&3" class="object-cover w-full h-32" alt=""></a>
            <a href="https://source.unsplash.com/random/800x603?music" data-fslightbox="galeria"><img src="https://source.unsplash.com/random/400x300?music&4" class="object-cover w-full h-32" alt=""></a>
        </div>
    </div>
</section>

<section id="testemunhos" class="py-12" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6 text-center">Testemunhos</h2>
        <div id="testimonyCarousel" class="max-w-2xl mx-auto">
            <div class="testimony text-center"><p class="italic">"Deus transformou minha vida através desta igreja."</p><span class="block mt-2 font-bold">Maria</span></div>
            <div class="testimony hidden text-center"><p class="italic">"Aqui encontrei uma família espiritual."</p><span class="block mt-2 font-bold">João</span></div>
            <div class="testimony hidden text-center"><p class="italic">"As mensagens têm me inspirado diariamente."</p><span class="block mt-2 font-bold">Ana</span></div>
        </div>
    </div>
</section>

<section id="contato" class="py-12 bg-gray-100 dark:bg-gray-800" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-6">Fale Conosco</h2>
        <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
            @csrf
            <div><label class="block">Nome</label><input type="text" name="name" class="w-full p-2 border rounded" required></div>
            <div><label class="block">Email</label><input type="email" name="email" class="w-full p-2 border rounded" required></div>
            <div><label class="block">Mensagem</label><textarea name="message" class="w-full p-2 border rounded" required></textarea></div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enviar</button>
        </form>
    </div>
</section>
@endsection
