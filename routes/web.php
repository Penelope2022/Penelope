<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::post('/contato', [SiteController::class, 'submitContact'])->name('contact.submit');
