<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [LoginRegisterController::class, 'login']);
Route::post('logout', [LoginRegisterController::class, 'logout']);
Route::post('register', [LoginRegisterController::class, 'register']);

// not available for unathorized access. Must have an access token
Route::middleware(['auth:api'])->group(function () {

    Route::resource('customers', CustomerController::class);
    Route::get('/customers/{id}/restore', [CustomerController::class, 'restore']);
    Route::get('/customers/{id}/force-delete', [CustomerController::class, 'forceDelete']);

    Route::resource('medications', MedicationController::class);
    Route::get('/medications/{id}/restore', [MedicationController::class, 'restore']);
    Route::get('/medications/{id}/force-delete', [MedicationController::class, 'forceDelete']);    
});