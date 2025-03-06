<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas del perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de experiencias laborales
    Route::resource('work-experiences', WorkExperienceController::class);

    // Rutas de habilidades
    Route::resource('skills', SkillController::class);
    Route::get('/skills/search', [SkillController::class, 'search'])->name('skills.search');

    // Rutas de usuarios
    Route::resource('users', UserController::class)->except(['edit', 'update']);
});

require __DIR__.'/auth.php';
