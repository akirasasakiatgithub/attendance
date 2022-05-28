<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
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

Route::get('/register', [AuthController::class, 'getRegister']);
Route::post('/register', [AuthController::class, 'postRegister']);
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/', function () {
    $user = Auth::user();
    return view('index', ['user' => $user]);
})->name('index');
//[AttendanceController::class, 'getIndex']);
Route::get('/attendance/start', [AttendanceController::class, 'startAttendance']);
Route::get('/attendance/end', [AttendanceController::class, 'endAttendance']);
//本番は/attendance/{num}で登録
Route::get('/attendance', [AttendanceController::class, 'getAttendance'])->name('atte');
Route::get('/break/start', [RestController::class, 'startRest']);
Route::get('/break/end', [RestController::class, 'endtRest']);

Route::get('/test', [AttendanceController::class, 'test']);

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';*/
