<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\Client;
use App\Services\ClientService;

class ClientController extends Controller
{
    private ClientService $clients;

    public function __construct(ClientService $clients)
    {
        $this->clients = $clients;
    }

    public function index()
    {
        $items = Client::latest()->paginate();
        return view('admin.clients.index', compact('items'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(ClientRequest $request)
    {
        $this->clients->create($request->validated());
        return redirect()->route('admin.clients.index')->with('status', 'Cliente criado');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, Client $client)
    {
        $this->clients->update($client, $request->validated());
        return redirect()->route('admin.clients.index')->with('status', 'Cliente atualizado');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('status', 'Cliente removido');
    }
}
