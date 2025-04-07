<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleCalendarController;


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


Route::get('/google-calendar/connect', [GoogleCalendarController::class, 'redirect'])->name('google.calendar.connect');
Route::get('/google-calendar/callback', [GoogleCalendarController::class, 'callback'])->name('google.calendar.callback');


Route::post('/add-to-calendar/{appointment_id}', [AppointmentController::class, 'addToCalendar'])->name('addToCalendar');



require __DIR__.'/auth.php';
