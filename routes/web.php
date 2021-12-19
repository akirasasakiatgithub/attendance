<?php

use App\Http\Controllers\AtteController;
use App\Http\Controllers\RegisterdUserController;
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
Route::get('/register', [AuthController::class, 'getRegister']);
Route::post('/register', [AuthController::class, 'postRegister']);
Route::get('/login', [AuthController::class, 'getLogin']);
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/', [AttendanceController::class, 'getIndex']);
Route::get('/attendance/start', [AttendanceController::class, 'startAttendance']);
Route::get('/attendance/end', [AttendanceController::class, 'endAttendance']);
Route::get('/attendance/{num}', [AttendanceController::class, 'getAttendance']);
Route::get('/break/start', [RestController::class, 'startRest']);
Route::get('/break/end', [RestController::class, 'endtRest']);
