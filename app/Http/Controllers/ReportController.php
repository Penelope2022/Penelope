<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/login');
        }

        $summary = [
            'infos' => count($request->session()->get('infos', [])),
            'posts' => count($request->session()->get('posts', [])),
            'files' => count($request->session()->get('files', [])),
            'buttons' => count($request->session()->get('buttons', [])),
        ];

        return view('panel.reports', ['summary' => $summary]);
    }
}

