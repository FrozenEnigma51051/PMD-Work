<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;

// Media routes
Route::get('/media/create', [MediaController::class, 'create'])->name('media.create');
Route::post('/media', [MediaController::class, 'store'])->name('media.store');