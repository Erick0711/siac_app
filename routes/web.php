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
    return view('admin.inicio');
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
Route::view('/permisos', 'admin.permission')->middleware('can:login')->name('permission');

Route::view('/persona', 'admin.persona')->middleware('can:mostrar-persona')->name('persona');
// Route::view('/persona', 'admin.persona')->middleware('can:mostrar-persona')->name('persona');
Route::view('/funcionario', 'admin.funcionario')->middleware('can:mostrar-funcionario')->name('persona');

Route::view('/cargo', 'admin.cargo')->middleware('can:mostrar-cargo')->name('cargo');
Route::view('/copropietario', 'admin.copropietario')->middleware('can:mostrar-copropietario')->name('copropietario');
Route::view('/apartamento', 'admin.apartamento')->middleware('can:mostrar-apartamento')->name('apartamento');
Route::view('/pabellon', 'admin.pabellon')->middleware('can:mostrar-pabellon')->name('pabellon');
Route::view('/estacionamiento', 'admin.estacionamiento')->middleware('can:mostrar-estacionamiento')->name('estacionamiento');
Route::view('/vehiculo', 'admin.vehiculo')->middleware('can:mostrar-vehiculo')->name('vehiculo');
Route::view('/tipopago', 'admin.tipopago')->middleware('can:mostrar-articulo')->name('tipopago');
Route::view('/periodo', 'admin.periodo')->middleware('can:mostrar-periodo')->name('periodo');
Route::view('/gestion', 'admin.gestion')->middleware('can:mostrar-gestion')->name('gestion');
Route::view('/tipoarticulo', 'admin.tipoarticulo')->middleware('can:mostrar-tipoarticulo')->name('tipoarticulo');
Route::view('/articulo', 'admin.articulo')->middleware('can:mostrar-articulo')->name('articulo');
Route::view('/tipopago', 'admin.tipoPago')->middleware('can:mostrar-tipopago')->name('tipopago');
Route::view('/pago', 'admin.pago')->middleware('can:login')->name('pago');












// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
