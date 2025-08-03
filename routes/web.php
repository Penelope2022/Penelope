<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ButtonController;
use App\Http\Controllers\ReportController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::post('/contato', [SiteController::class, 'submitContact'])->name('contact.submit');
Route::get('/eventos', [EventController::class, 'index'])->name('events.index');
Route::get('/ministerios', [MinistryController::class, 'index'])->name('ministries.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/panel', [DashboardController::class, 'index'])->name('panel');
Route::get('/panel/info', [InfoController::class, 'index']);
Route::post('/panel/info', [InfoController::class, 'store']);
Route::get('/panel/blog', [BlogController::class, 'index']);
Route::post('/panel/blog', [BlogController::class, 'store']);
Route::get('/panel/downloads', [DownloadController::class, 'index']);
Route::post('/panel/downloads', [DownloadController::class, 'store']);
Route::get('/panel/buttons', [ButtonController::class, 'index']);
Route::post('/panel/buttons', [ButtonController::class, 'store']);
Route::get('/panel/reports', [ReportController::class, 'index']);

