<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\AuthenticatedUser;
use App\Http\Middleware\ValidateRequestCreateCustomer;
use App\Http\Middleware\ValidateRequestLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware(ValidateRequestLogin::class);

// Rutas con autenticacion
Route::middleware(AuthenticatedUser::class)->group(function () {

    // Rutas para los customers
    Route::controller(CustomerController::class)->prefix('customers')->group(function () {

        // Crear 
        Route::post('/create', 'store')->middleware(ValidateRequestCreateCustomer::class);

        // Consultar, con el param search ya sea por dni o email
        Route::get('/{search?}', 'index');

        // Eliminar
        Route::delete('/delete/{dni}', 'destroy');
    });
});
