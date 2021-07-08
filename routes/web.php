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

Route::get('/','App\Http\Controllers\Auth\LoginController@showLoginForm')->name('index');

Route::get('/FormRegister',function(){
    return view('auth.registerForm');
})->name('auth.register');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/Pegawai/delete', [PegawaiController::class, 'delete'])->name('Pegawai.delete');
Route::get('/Pegawai/search', [PegawaiController::class, 'search'])->name('Pegawai.search');
Route::resource('Pegawai', 'App\Http\Controllers\MasterData\PegawaiController');

Route::resource('Menu', 'App\Http\Controllers\MasterData\MenuController');
Route::post('Menu/Read','App\Http\Controllers\MasterData\MenuController@read')->name('Menu.Read');

Route::get('KategoriBarang/','App\Http\Controllers\MasterData\KategoriBarangController@index')->name('KtgBrg.index');
Route::post('KategoriBarang/Read','App\Http\Controllers\MasterData\KategoriBarangController@read')->name('KtgBrg.Read');
Route::post('KategoriBarang/Store','App\Http\Controllers\MasterData\KategoriBarangController@store')->name('KtgBrg.Store');

Route::get('/COA', function(){
    return "COA";
})->name('COA.index');
Route::get('/Penggajian', function(){
    return "COA";
})->name('Penggajian.index');
Route::get('/Laporan', function(){
    return "COA";
})->name('Laporan.index');

Route::get('/Checkout','App\Http\Controllers\Transaction\checkOutPesananController@index')->name('Checkout.index');
Route::Post('/Checkout/Selesai','App\Http\Controllers\Transaction\checkOutPesananController@selesaiPesan')->name('Checkout.selesaiPesan');
Route::post('/Checkout','App\Http\Controllers\Transaction\checkOutPesananController@getParentKtgBrg')->name('Checkout.getParentBarang');

Route::get('/Jurnal', function(){
    return "COA";
})->name('Jurnal.index');

Route::get('/Pembelian', function(){
    return "COA";
})->name('Pembelian.index');
