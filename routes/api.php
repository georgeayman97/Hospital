<?php

use App\Http\Controllers\Api\AppointmentsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/tokens', [AppointmentsApiController::class, 'store']);
Route::middleware('auth:sanctum')->get('appointments', [AppointmentsApiController::class, 'getAppointments']);
Route::get('specialities', [AppointmentsApiController::class, 'getSpeciality']);
Route::middleware('auth:sanctum')->get('appointments/user', [AppointmentsApiController::class, 'getUserAppointments']);
Route::middleware('auth:sanctum')->post('appointments', [AppointmentsApiController::class, 'createAppointment']);

