<?php

use App\Http\Controllers\Api\APIInstallationController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\RecordMeterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\SuperAdmin\InstallationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::post('/record-meters/create', [RecordMeterController::class, 'create']);

    Route::post('/payments', [PaymentController::class, 'create']);
});

Route::get('customers', [CustomerController::class, 'all']);

Route::get('/record-meters', [RecordMeterController::class, 'index']);

Route::get('/complaint', [ComplaintController::class, 'index']);

Route::get('/payment', [PaymentController::class, 'getPaymentData']);
