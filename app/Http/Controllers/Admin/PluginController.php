<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PluginRequest;
use App\Models\Plugin;
use App\Services\PluginService;

class PluginController extends Controller
{
    private PluginService $plugins;

    public function __construct(PluginService $plugins)
    {
        $this->plugins = $plugins;
    }

    public function index()
    {
        $items = Plugin::latest()->paginate();
        return view('admin.plugins.index', compact('items'));
    }

    public function create()
    {
        return view('admin.plugins.create');
    }

    public function store(PluginRequest $request)
    {
        $data = $request->validated();
        $data['file'] = $request->file('file');
        $this->plugins->create($data);
        return redirect()->route('admin.plugins.index')->with('status', 'Plugin criado');
    }

    public function toggle(Plugin $plugin)
    {
        $this->plugins->toggle($plugin);
        return redirect()->route('admin.plugins.index')->with('status', 'Plugin atualizado');
    }

    public function destroy(Plugin $plugin)
    {
        $this->plugins->delete($plugin);
        return redirect()->route('admin.plugins.index')->with('status', 'Plugin removido');
    }
}
