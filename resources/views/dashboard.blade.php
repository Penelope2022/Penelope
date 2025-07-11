@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white shadow rounded p-4 text-center">
            <p class="text-gray-500">Usuários</p>
            <p class="text-3xl font-semibold">{{ $counts['users'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center">
            <p class="text-gray-500">Clientes</p>
            <p class="text-3xl font-semibold">{{ $counts['clients'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center">
            <p class="text-gray-500">Plugins</p>
            <p class="text-3xl font-semibold">{{ $counts['plugins'] }}</p>
        </div>
    </div>
    <canvas id="kpiChart" height="100"></canvas>
    <div class="mt-4 space-x-4">
        <a href="{{ route('admin.clients.index') }}" class="text-blue-500">Gerenciar Clientes</a>
        <a href="{{ route('admin.plugins.index') }}" class="text-blue-500">Gerenciar Plugins</a>
    </div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('kpiChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Usuários', 'Clientes', 'Plugins'],
            datasets: [{
                label: 'Total',
                data: [{{ $counts['users'] }}, {{ $counts['clients'] }}, {{ $counts['plugins'] }}],
                backgroundColor: ['#6366f1', '#14b8a6', '#f97316']
            }]
        }
    });
</script>
@endpush
