<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterData\COAController;
use App\Http\Controllers\Transaction\ReturController;
use App\Http\Controllers\MasterData\PegawaiController;
use App\Http\Controllers\Transaction\PembelianController;
use App\Http\Controllers\Report\LaporanPenjualanController;
use App\Http\Controllers\Transaction\CustomPesananController;
use App\Http\Controllers\Transaction\checkOutPesananController;
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

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('index');

    Route::get('/FormRegister', function () {
        return view('auth.registerForm');
    })->name('auth.register');

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::post('/Pegawai/delete', [PegawaiController::class, 'delete'])->name('Pegawai.delete');
Route::get('/Pegawai/search', [PegawaiController::class, 'search'])->name('Pegawai.search');
Route::resource('Pegawai', 'App\Http\Controllers\MasterData\PegawaiController');

Route::resource('Menu', 'App\Http\Controllers\MasterData\MenuController');
Route::post('Menu/Read', 'App\Http\Controllers\MasterData\MenuController@read')->name('Menu.Read');

// Kategori Barang
Route::get('KategoriBarang/', 'App\Http\Controllers\MasterData\KategoriBarangController@index')->name('KtgBrg.index');
Route::post('KategoriBarang/Read', 'App\Http\Controllers\MasterData\KategoriBarangController@read')->name('KtgBrg.Read');
Route::post('KategoriBarang/Store', 'App\Http\Controllers\MasterData\KategoriBarangController@store')->name('KtgBrg.Store');

// COA
Route::get('/COA', [COAController::class, 'index'])->name('COA.index');
Route::POST('/COA/Read', [COAController::class, 'read'])->name('COA.Read');
Route::POST('/COA/Store', [COAController::class, 'store'])->name('COA.Store');

Route::get('/Penggajian', function () {
    return "COA";
})->name('Penggajian.index');
Route::get('/Laporan', function () {
    return "COA";
})->name('Laporan.index');

Route::group(['middleware'=>['role:admin']],function(){
    //checkout Pesanan
    Route::get('/Checkout', 'App\Http\Controllers\Transaction\checkOutPesananController@index')->name('Checkout.index');
    Route::post('/Checkout', 'App\Http\Controllers\Transaction\checkOutPesananController@getParentKtgBrg')->name('Checkout.getParentBarang');
    Route::Post('/Checkout/Selesai', 'App\Http\Controllers\Transaction\checkOutPesananController@selesaiPesan')->name('Checkout.selesaiPesan');
    Route::get('/CustomPesanan/CetakStruk', [checkOutPesananController::class, 'cetakStruk'])->name('Checkout.cetakStruk');
    //Retur Barang
    Route::get('/Retur', [ReturController::class, 'index'])->name('Retur.index');
    Route::get('/Retur/tambah', [ReturController::class, 'Add'])->name('Retur.Add');
    Route::POST('/Retur/read', [ReturController::class, 'read'])->name('Retur.Read');
    Route::POST('/Retur/detail', [ReturController::class, 'GetDetailRetur'])->name('Retur.Detail');
    Route::POST('/Retur/save', [ReturController::class, 'SaveProcess'])->name('Retur.Save');
    Route::POST('/Retur/getId', [ReturController::class, 'GetByIdTrans'])->name('Retur.getByIdTrans');
    // Pembelian
    Route::get('/Pembelian', [PembelianController::class, 'index'])->name('Pembelian.index');
    Route::post('/Pembelian', [PembelianController::class, 'barang'])->name('Pembelian.barang');
    Route::post('/Pembelian/Simpan', [PembelianController::class, 'simpan'])->name('Pembelian.simpan');
    // Custom pesanan
    Route::get('/CustomPesanan', [CustomPesananController::class, 'index'])->name('CustomPesanan.index');
    Route::post('/CustomPesanan', [CustomPesananController::class, 'getParentKtgBrg'])->name('CustomPesanan.barang');
    Route::post('/CustomPesanan/Simpan', [CustomPesananController::class, 'selesaiPesan'])->name('CustomPesanan.simpan');
    Route::get('/CustomPesanan/cetakInvoice', [CustomPesananController::class, 'generateInvoice'])->name('CustomPesanan.invoice');
    // Pengeluaran Kas
    Route::get('/Pengeluaran', [CustomPesananController::class, 'index'])->name('Pengeluaran.index');

    // Laporan Penjualan
    Route::post('/LaporanPenjualan', [LaporanPenjualanController::class, 'CustomPesanan'])->name('Report.LaporanPenjualan');
    Route::get('/Laporan', [LaporanPenjualanController::class, 'Index'])->name('Report.index');
    // Route::post('/LaporanPenjualan/customPesanan', [LaporanPenjualanController::class, 'CustomPesanan'])->name('Report.LaporanPenjualan');
    // Route::post('/Pembelian/Simpan', [CustomPesananController::class, 'simpan'])->name('Pembelian.simpan');
});

Route::get('/Jurnal', function () {
    return "COA";
})->name('Jurnal.index');
Route::get('/invoice', function () {
    return view('Transaction.CustomPesanan.Invoice');
})->name('invoice');

Route::get('/struk', function () {
    return view('Transaction.Checkout.Struk');
})->name('struk');

// Route::get('/LaporanPenjualan', function () {
//     $titleBreadcrump = 'Laporan Penjualan';
//     return view('Report.LapPenj',compact('titleBreadcrump'));
// })->name('laporan');


