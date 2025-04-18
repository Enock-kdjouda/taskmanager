<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\InterfaceController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Routes accessibles uniquement aux admins
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'role:chef,admin'])->group(function () {
    // Routes pour les chefs de projet et admins
});

Route::middleware(['auth', 'role:membre,chef,admin'])->group(function () {
    // Routes accessibles à tous les rôles
});


Route::resource('projects', ProjectController::class)->middleware('auth');
Route::resource('tasks', TaskController::class)->middleware('auth');
Route::get('/interface', [InterfaceController::class, 'index'])->middleware('auth')->name('interface.index');





require __DIR__.'/auth.php';
