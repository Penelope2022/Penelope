<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MinistryController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::post('/contato', [SiteController::class, 'submitContact'])->name('contact.submit');
Route::get('/eventos', [EventController::class, 'index'])->name('events.index');
Route::get('/ministerios', [MinistryController::class, 'index'])->name('ministries.index');
