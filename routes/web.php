<?php

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});    

Route::resource('appointment',AppointmentsController::class);
// Route::get('userAppointments',[AppointmentsController::class,'clientIndex'])->name('user.appointments');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'clientIndex'])->name('home.client');
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
