<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterData\PegawaiController;

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
    return view('auth.loginForm');
})->name('index');

Route::get('/FormRegister',function(){
    return view('auth.registerForm');
})->name('auth.register');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/Pegawai/search', [PegawaiController::class, 'search'])->name('Pegawai.search');
Route::resource('Pegawai', 'App\Http\Controllers\MasterData\PegawaiController');
Route::resource('Menu', 'App\Http\Controllers\MasterData\MenuController');

