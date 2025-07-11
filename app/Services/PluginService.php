<?php
namespace App\Services;

use App\Models\Plugin;
use Illuminate\Support\Facades\Storage;

class PluginService
{
    /**
     * Store a new plugin and return it.
     */
    public function create(array $data): Plugin
    {
        if (isset($data['file']) && $data['file']->isValid()) {
            $path = $data['file']->store('plugins');
            $data['path'] = $path;
        }
        unset($data['file']);
        return Plugin::create($data);
    }

    /**
     * Toggle plugin state.
     */
    public function toggle(Plugin $plugin): Plugin
    {
        $plugin->enabled = !$plugin->enabled;
        $plugin->save();
        return $plugin;
    }

    /**
     * Delete plugin and its file.
     */
    public function delete(Plugin $plugin): void
    {
        if ($plugin->path) {
            Storage::delete($plugin->path);
        }
        $plugin->delete();
    }
}
