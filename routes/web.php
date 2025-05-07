<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAdminOrPhysio;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// MIS RUTAS
Route::get('/services', [TreatmentController::class, 'indexClients'])->name('treats');

Route::get('/get-appointment/', [AppointmentController::class, 'create'])->name('newappointment')->middleware(['auth', 'verified']);
Route::post('/get-appointment', [AppointmentController::class, 'store'])->name('storedappointment')->middleware(['auth', 'verified']);

Route::get('auth/google', [GoogleController::class, 'googlepage']);
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);


Route::get('/google-calendar/connect', [GoogleCalendarController::class, 'redirect'])->middleware(['auth', 'verified'])->name('google.calendar.connect');
Route::get('/google-calendar/callback', [GoogleCalendarController::class, 'callback'])->middleware(['auth', 'verified'])->name('google.calendar.callback');


Route::post('/add-to-calendar/{appointment_id}', [AppointmentController::class, 'addToCalendar'])->middleware(['auth', 'verified'])->name('addToCalendar');


Route::resource('user', ProfileController::class)->middleware(IsAdmin::class);

Route::resource('treatment', TreatmentController::class)->middleware(IsAdminOrPhysio::class);
Route::resource('appointment', AppointmentController::class)->middleware(IsAdminOrPhysio::class);
Route::resource('users', UserController::class)->middleware(IsAdminOrPhysio::class);
Route::get('appointment/custom/createForPhysio', [AppointmentController::class, 'createForPhysio'])
->middleware(IsAdminOrPhysio::class)
->name('createForPhysio');

//CONTACTO
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


// MIS CITAS
Route::get('/my-appointments', [UserController::class, 'myAppointments'])->name('myappointments')->middleware(['auth', 'verified']);
Route::delete('/my-appointment/{appointment}', [AppointmentController::class, 'destroyForPatient'])->middleware(['auth', 'verified'])->name("destroyForPatient");
require __DIR__.'/auth.php';
