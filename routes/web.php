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
});

Route::get('/home', function () {
    return view('/home');
});

Route::get('/login', function () {
    return view('/auth.login');
})->name('login');

Route::get('/register', function () {
    return view('/auth.register');
})->name('register');

Route::view('/usuario', 'admin.user')->middleware('can:login')->name('user');
Route::view('/rol', 'admin.rol')->middleware('can:login')->name('user');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
