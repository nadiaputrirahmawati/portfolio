<?php

use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\MessegeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectsController;
use App\Models\Project;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/project/{slug}', [PortfolioController::class, 'detail']);

// Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/project', [ProjectController::class, 'Dashboard'])->middleware(['auth', 'verified'])->name('project');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', ProjectsController::class);
    Route::resource('achievements', AchievementsController::class);
    Route::resource('experiences', ExperiencesController::class);
});

Route::post('/upload', [ProjectsController::class, 'upload'])->name('projects.upload');

require __DIR__.'/auth.php';
