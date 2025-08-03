<?php

namespace App\Http\Controllers;

class EventController extends Controller
{
    public function index()
    {
        $events = [
            ['title' => 'Culto de Jovens', 'start' => '2024-07-06'],
            ['title' => 'Semana de Oração', 'start' => '2024-07-10'],
        ];

        return view('events.index', compact('events'));
    }
}

