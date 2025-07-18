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
use App\Http\Middleware\ProfileComplete;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return redirect("/dashboard");
});

Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(ProfileComplete::class);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(ProfileComplete::class);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware(ProfileComplete::class);
});

//PROTEJO LAS RUTAS CON EL MIDDLEWARE PARA QUE COMPLETEN SUS PERFILES SI O SI
Route::middleware(ProfileComplete::class)->group(function(){

// RUTAS PARA CLIENTES
Route::get('/get-appointment/', [AppointmentController::class, 'create'])->name('newappointment')->middleware(['auth', 'verified']);
Route::post('/get-appointment', [AppointmentController::class, 'store'])->name('storedappointment')->middleware(['auth', 'verified']);
Route::post('/add-to-calendar/{appointment_id}', [AppointmentController::class, 'addToCalendar'])->middleware(['auth', 'verified'])->name('addToCalendar');

//RECURSOS
Route::resource('user', ProfileController::class)->middleware(IsAdmin::class);
Route::resource('treatment', TreatmentController::class)->middleware(IsAdminOrPhysio::class);
Route::resource('users', UserController::class)->middleware(IsAdminOrPhysio::class);
Route::resource('appointment', AppointmentController::class)->middleware(IsAdminOrPhysio::class);

// CREAR LA CITA PARA EL FISIO
Route::get('appointment/custom/createForPhysio', [AppointmentController::class, 'createForPhysio'])
->middleware(IsAdminOrPhysio::class)
->name('createForPhysio');

// MIS CITAS
Route::get('/my-appointments', [UserController::class, 'myAppointments'])->name('myappointments')->middleware(['auth', 'verified']);
Route::delete('/my-appointment/{appointment}', [AppointmentController::class, 'destroyForPatient'])->middleware(['auth', 'verified'])->name("destroyForPatient");

//LEGAL
Route::get('/legal-notice', function () {return view('clients.legal-notice');})->name('legal-notice');
Route::get('/privacy-policy', function () {return view('clients.privacy-policy');})->name('privacy-policy');


Route::post('/profile', [ProfileController::class, 'storeSpecialist'])->name('specialist.add');
Route::delete('/profile/speciality/{specialist}', [ProfileController::class, 'spcialistDestroy'])->name('specilist.destroy');


});

Route::get('/services', [TreatmentController::class, 'indexClients'])->name('treats');



//CONTACTO
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

//LOGIN CON GOOGLE
Route::get('auth/google', [GoogleController::class, 'googlepage'])->name('googlepage');
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);

//COMPLETAR DATOS FALTANTES
Route::post('/google/store-missing', [GoogleController::class, 'storeMissingData'])->name('google.storeMissing');
Route::get('/google/calendar/callback', [GoogleController::class, 'calendarCallback'])->name('google.calendar.callback');


require __DIR__.'/auth.php';
