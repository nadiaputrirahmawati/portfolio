<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PortfolioController;

// Prefix '/api' otomatis ditambahkan oleh Laravel
Route::get('/projects', [PortfolioController::class, 'projects']);
Route::get('/experiences', [PortfolioController::class, 'experiences']);
Route::get('/achievements', [PortfolioController::class, 'achievements']);

// Route all-in-one (opsional tapi sangat disarankan)
Route::get('/portfolio-data', [PortfolioController::class, 'allData']);

Route::get('/project/{slug}', [PortfolioController::class, 'detailData']);