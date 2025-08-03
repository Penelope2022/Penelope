<?php

namespace App\Http\Controllers;

class MinistryController extends Controller
{
    public function index()
    {
        $ministries = [
            ['name' => 'Jovens', 'description' => 'Ministério voltado para os jovens da igreja.'],
            ['name' => 'Música', 'description' => 'Equipe de louvor e adoração.'],
            ['name' => 'Escola Sabatina', 'description' => 'Estudo da Bíblia em classes.'],
        ];

        return view('ministries.index', compact('ministries'));
    }
}

