<?php

use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessegeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectsController;
use App\Models\Project;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         // 'canLogin' => Route::has('login'),
//         // 'canRegister' => Route::has('register'),
//         // 'laravelVersion' => Application::VERSION,
//         // 'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/project/{slug}', [PortfolioController::class, 'detail']);

Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/project', [ProjectController::class, 'Dashboard'])->middleware(['auth', 'verified'])->name('project');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    // Route::resource('messege', MessegeController::class);
    Route::resource('projects', ProjectsController::class);
    Route::resource('achievements', AchievementsController::class);
});

Route::post('/upload', [ProjectsController::class, 'upload'])->name('projects.upload');

require __DIR__.'/auth.php';
