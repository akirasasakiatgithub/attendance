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
Route::get('/register', [RegisterdUserController::class, 'register']);
Route::post('/register', [RegisterdUserController::class, 'store']);
Route::get('/login', [AtteController::class, 'login']);
Route::post('/login', [AtteController::class, 'stamp']);
Route::get('/', [AtteController::class, 'home']);
Route::post('/', [AtteController::class, 'submit']);
Route::get('/attendance', [AtteController::class, 'record']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//require __DIR__.'/auth.php';
