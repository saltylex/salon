<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $stats = [
        'services' => Service::count(),
        'appointments' => Appointment::where('status', 'confirmed')->count(),
        'revenue' => Payment::where('status', 'paid')->sum('amount'),
    ];

    $recentAppointments = Appointment::with('service')
        ->latest()
        ->take(5)
        ->get();

    $recentPayments = Payment::with('appointment')
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact('stats', 'recentAppointments', 'recentPayments'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Services
    Route::resource('services', ServiceController::class);

    // Appointments
    Route::resource('appointments', AppointmentController::class);

    // Payments
    Route::resource('payments', PaymentController::class);
});

require __DIR__.'/auth.php';
