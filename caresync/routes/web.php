<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SpecialDateController;

// === ROTAS PÚBLICAS ===
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'processRegister']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);


// === ROTAS PROTEGIDAS ===
Route::middleware('auth')->group(function () {

    // Dashboard e Sair
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // === MÓDULO DE CONSULTAS ===
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::get('/appointments/create', [AppointmentController::class, 'create']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);
    Route::get('/appointments/{id}/edit', [\App\Http\Controllers\AppointmentController::class, 'edit']);
    Route::put('/appointments/{id}', [\App\Http\Controllers\AppointmentController::class, 'update']);

    // === MÓDULO DE MEDICAMENTOS ===
    Route::get('/medications', [MedicationController::class, 'index']);
    Route::get('/medications/create', [MedicationController::class, 'create']);
    Route::post('/medications', [MedicationController::class, 'store']);
    Route::delete('/medications/{id}', [MedicationController::class, 'destroy']);
    Route::get('/medicines/create', [MedicineController::class, 'create']);
    Route::post('/medicines', [MedicineController::class, 'store']);
    Route::get('/medications', [\App\Http\Controllers\MedicationController::class, 'index']);
    Route::delete('/medications/{id}', [\App\Http\Controllers\MedicationController::class, 'destroy']);
    // === MÓDULO DE MÉDICOS ===
    Route::get('/doctors', [\App\Http\Controllers\DoctorController::class, 'index']);
    Route::get('/doctors/create', [\App\Http\Controllers\DoctorController::class, 'create']);
    Route::post('/doctors', [\App\Http\Controllers\DoctorController::class, 'store']);
    Route::get('/doctors/{id}/edit', [\App\Http\Controllers\DoctorController::class, 'edit']);
    Route::put('/doctors/{id}', [\App\Http\Controllers\DoctorController::class, 'update']);
    Route::delete('/doctors/{id}', [\App\Http\Controllers\DoctorController::class, 'destroy']);

    Route::get('/special-dates/create', [SpecialDateController::class, 'create']);
    Route::post('/special-dates', [SpecialDateController::class, 'store']);

    Route::delete('/medications/{id}/taken', [\App\Http\Controllers\MedicationController::class, 'taken']);
    Route::patch('/medications/{id}/taken', [\App\Http\Controllers\MedicationController::class, 'taken']);
});
Route::post('/water/add', function (Illuminate\Http\Request $request) {
    \App\Models\WaterLog::create([
        'user_id' => Auth::id(),
        'amount' => 250
    ]);
    return redirect('/#jornada')->with('sucesso', 'Mais 250ml registrados!');
});