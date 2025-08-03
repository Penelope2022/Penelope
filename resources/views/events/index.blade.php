@extends('layouts.app')

@section('title', 'Eventos')

@push('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css">
@endpush

@section('content')
<section class="py-12" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-semibold mb-6">Agenda de Eventos</h1>
        <div id="calendar" class="mb-8"></div>
        <ul class="space-y-4">
            @foreach($events as $event)
                <li class="p-4 border rounded">
                    <h2 class="text-xl font-bold">{{ $event['title'] }}</h2>
                    <p class="text-gray-600">{{ \Carbon\Carbon::parse($event['start'])->format('d/m/Y') }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($events)
        });
        calendar.render();
    }
});
</script>
@endpush
