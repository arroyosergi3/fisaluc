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
use Illuminate\Support\Facades\Mail;

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
Route::get('/services', [TreatmentController::class, 'indexClients'])->name('treats');

Route::get('/get-appointment/', [AppointmentController::class, 'create'])->name('newappointment');
Route::post('/get-appointment', [AppointmentController::class, 'store'])->name('storedappointment');

Route::get('auth/google', [GoogleController::class, 'googlepage']);
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);


Route::get('/google-calendar/connect', [GoogleCalendarController::class, 'redirect'])->name('google.calendar.connect');
Route::get('/google-calendar/callback', [GoogleCalendarController::class, 'callback'])->name('google.calendar.callback');


Route::post('/add-to-calendar/{appointment_id}', [AppointmentController::class, 'addToCalendar'])->name('addToCalendar');


Route::resource('user', ProfileController::class)->middleware(IsAdmin::class);

Route::resource('treatment', TreatmentController::class)->middleware(IsAdminOrPhysio::class);
Route::resource('appointment', AppointmentController::class)->middleware(IsAdminOrPhysio::class);
Route::resource('users', UserController::class)->middleware(IsAdminOrPhysio::class);
Route::get('appointment/custom/createForPhysio', [AppointmentController::class, 'createForPhysio'])
//->middleware(IsAdminOrPhysio::class)
->name('createForPhysio');

//CONTACTO
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::get('/mail-test', function () {
    Mail::raw('Esto es un correo de prueba desde Laravel', function ($message) {
        $message->to('TU_CORREO_REAL@gmail.com')
                ->subject('Prueba desde Laravel');
    });

    return 'Correo de prueba enviado (si todo salió bien)';
});

require __DIR__.'/auth.php';
