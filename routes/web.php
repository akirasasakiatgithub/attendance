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
Route::get('/logout', [AuthController::class, 'getLogout'])->name('logout');
Route::get('/', [AttendanceController::class, 'getIndex'])->name('index')->middleware('auth');
Route::get('/attendance/start', [AttendanceController::class, 'startAttendance']);
Route::get('/attendance/end', [AttendanceController::class, 'endAttendance']);
Route::get('/attendance/{num}', [AttendanceController::class, 'getAttendance'])->name('atte');
Route::post('/attendance', [AttendanceController::class, 'getAttendance']);
Route::get('/person/{num}', [AttendanceController::class, 'getPersonAttendance'])->name('person_atte');
Route::post('/person', [AttendanceController::class, 'getPersonAttendance']);
Route::get('/break/start', [RestController::class, 'startBreak']);
Route::get('/break/end', [RestController::class, 'endBreak']);

Route::get('/test', [AttendanceController::class, 'test']);

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

//require __DIR__.'/auth.php';
