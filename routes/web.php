<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::post('/contato', [SiteController::class, 'submitContact'])->name('contact.submit');
Route::get('/eventos', [EventController::class, 'index'])->name('events.index');
Route::get('/ministerios', [MinistryController::class, 'index'])->name('ministries.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/panel', [DashboardController::class, 'index'])->name('panel');

