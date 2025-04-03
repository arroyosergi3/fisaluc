<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\GoogleController;
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

// MIS RUTAS
Route::get('/services', [TreatmentController::class, 'index'])->name('treats');

Route::get('/get-appointment', [AppointmentController::class, 'create'])->name('newappointment');
Route::post('/get-appointment', [AppointmentController::class, 'store'])->name('storedappointment');

Route::get('auth/google', [GoogleController::class, 'googlepage']);
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);


require __DIR__.'/auth.php';
