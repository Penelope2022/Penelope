<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/login');
        }

        $files = $request->session()->get('files', []);
        return view('panel.downloads', ['files' => $files]);
    }

    public function store(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/login');
        }

        $data = $request->validate([
            'name' => 'required|string',
            'url' => 'required|url',
        ]);

        $files = $request->session()->get('files', []);
        $files[] = $data;
        $request->session()->put('files', $files);

        return redirect()->back()->with('status', 'Arquivo adicionado');
    }
}

