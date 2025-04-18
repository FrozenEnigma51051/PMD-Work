<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;

// Media routes
// Route::get('/media/create', [MediaController::class, 'create'])->name('media.create');
// Route::post('/media', [MediaController::class, 'store'])->name('media.store');

Route::get('/weather-form', function () {
    return view('weather-observation-form');
});
Route::post('/weather/store', function () {
    // For testing, just redirect back or to a success page
    return back()->with('success', 'Form submitted successfully!');
})->name('weather.store');

Route::get('/test-form', function () {
    return view('weather-observation-form');
});
