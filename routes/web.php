<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->middleware('role:admin|manager')->group(function () {
        Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);
        Route::get('plugins', [\App\Http\Controllers\Admin\PluginController::class, 'index'])->name('plugins.index');
        Route::get('plugins/create', [\App\Http\Controllers\Admin\PluginController::class, 'create'])->name('plugins.create');
        Route::post('plugins', [\App\Http\Controllers\Admin\PluginController::class, 'store'])->name('plugins.store');
        Route::post('plugins/{plugin}/toggle', [\App\Http\Controllers\Admin\PluginController::class, 'toggle'])->name('plugins.toggle');
        Route::delete('plugins/{plugin}', [\App\Http\Controllers\Admin\PluginController::class, 'destroy'])->name('plugins.destroy');
    });
});
