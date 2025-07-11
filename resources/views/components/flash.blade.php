@if (session('status'))
    <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
        {{ session('status') }}
    </div>
@endif
