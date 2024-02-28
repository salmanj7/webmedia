<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', [DoctorController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/doctor/create', [DoctorController::class, 'create'])->name('doctor.create');
    Route::post('/doctor/store', [DoctorController::class, 'store'])->name('doctor.store');

    Route::get('doctor/{doctor}/appointment', [AppointmentController::class,'index'])->name('appointment.show');

    Route::get('doctors/{doctor}/appointments', [AppointmentController::class, 'list'])->name('appointments.list');
    
    Route::post('doctors/{doctor}/appointments/store', [AppointmentController::class, 'store'])->name('doctors.appointments.store');

    Route::get('appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');


});

require __DIR__.'/auth.php';
