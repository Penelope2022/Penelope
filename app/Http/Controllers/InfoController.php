<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/login');
        }

        $infos = $request->session()->get('infos', []);
        return view('panel.info', ['infos' => $infos]);
    }

    public function store(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/login');
        }

        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $infos = $request->session()->get('infos', []);
        $infos[] = $data;
        $request->session()->put('infos', $infos);

        return redirect()->back()->with('status', 'Informação adicionada');
    }
}

