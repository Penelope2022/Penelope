<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/login');
        }

        $posts = $request->session()->get('posts', []);
        return view('panel.blog', ['posts' => $posts]);
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

        $posts = $request->session()->get('posts', []);
        $posts[] = $data;
        $request->session()->put('posts', $posts);

        return redirect()->back()->with('status', 'Post publicado');
    }
}

