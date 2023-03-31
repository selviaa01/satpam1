<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; //Mendaftarkan Controller
use App\Http\Controllers\PositionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');

Route::middleware('auth')->group(
    function () {
        Route::get('/', function () {
            return view('home', ['title' => 'Beranda']);
        })->name('home');
        Route::get('password', [UserController::class, 'password'])->name('password');
        Route::post('password', [UserController::class, 'password_action'])->name('password.action');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');

        //route position
        Route::resource('positions', PositionsController::class);

    });