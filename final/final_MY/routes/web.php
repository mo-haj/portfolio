<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\DoctorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('homebage');

Route::get('/error', function () {
    return view('error');
})->name('error');

Route::post('/register', [JWTController::class, 'register'])->name('register');
Route::post('/login', [JWTController::class, 'store'])->name('login');
Route::get('/singup', function () {
    return view('singup');
});

Route::middleware(['auth'])->group(function () {

Route::get('/logout', [JWTController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/calendar/{month?}', [AppointmentsController::class, 'index'])->name('calendar')->where('month', '[0-9]+');
Route::delete('/calendar/{appointment}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');

Route::post('/appointments/update', [AppointmentsController::class, 'update'])->name('appointmentsUpdate');
Route::post('/doctor/edit', [DoctorController::class, 'update'])->name('updateDoctor');

Route::get('/edit_doctor',  [DoctorController::class, 'edit'])->name('edit_doctor');
Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patient.destroy');
Route::get('/patient', [PatientController::class, 'index'])->name('patients');
Route::post('/patient/edit', [PatientController::class, 'update'])->name('updatepatient');
Route::post('/patient/add', [PatientController::class, 'store'])->name('addpatient');
Route::post('/patient/search',  [PatientController::class, 'search'])->name('searchPatient');

Route::get('/edit-appointments', function () {
    return view('edit_appointments');
});
Route::get('/edit/{patient}', [PatientController::class, 'show'])->name('patients.show');
Route::get('/profile/{patient}', [PatientController::class, 'showprofile'])->name('patients.show');
Route::get('/add-patients',[PatientController::class, 'show_new_patient'])->name('new.patient');

Route::get('/doctor_profile',  [DoctorController::class, 'show'])->name('Doctors.show');
Route::post('/calendar/search',  [AppointmentsController::class, 'search'])->name('searchAppointment');

Route::get('/appointments',  [AppointmentsController::class, 'storePage'])->name('storePage');
Route::post('/appointments/add',  [AppointmentsController::class, 'store'])->name('addappointment');

Route::resource('dates', 'DateController');

});
