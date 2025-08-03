<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ButtonController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/login');
        }

        $buttons = $request->session()->get('buttons', []);
        return view('panel.buttons', ['buttons' => $buttons]);
    }

    public function store(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/login');
        }

        $data = $request->validate([
            'label' => 'required|string',
            'link' => 'required|url',
        ]);

        $buttons = $request->session()->get('buttons', []);
        $buttons[] = $data;
        $request->session()->put('buttons', $buttons);

        return redirect()->back()->with('status', 'Botão criado');
    }
}

