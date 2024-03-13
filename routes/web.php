<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/home', function () {
    return view('/home');
})->middleware('auth');

Route::get('/login', function () {
    return view('/auth.login');
})->name('login');

Route::get('/register', function () {
    return view('/auth.register');
})->middleware('can:login')->name('register');

Route::view('/usuario', 'admin.user')->middleware('can:login')->name('user');
Route::view('/rol', 'admin.rol')->middleware('can:login')->name('rol');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
