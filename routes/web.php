<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\TransaksiKeluarController;
use App\Http\Controllers\TransaksiMasukController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['prefix'  => '/operator'],function(){
    Route::get('/dashboard',[BarangController::class, 'dashboard'])->name('operator.dashboard');
});

Route::group(['prefix'  => 'manajemen_barang/'],function(){
    Route::get('/',[BarangController::class, 'index'])->name('barang');
    Route::get('/add',[BarangController::class, 'add'])->name('barang.add');
    Route::post('/post',[BarangController::class, 'post'])->name('barang.post');
    Route::get('{id}/edit',[BarangController::class, 'edit'])->name('barang.edit');
    Route::patch('update/{id}',[BarangController::class, 'update'])->name('barang.update');
    Route::delete('/delete/{id}',[BarangController::class, 'delete'])->name('barang.delete');
});

Route::group(['prefix'  => 'transaksi_barang_masuk/'],function(){
    Route::get('/',[TransaksiMasukController::class, 'index'])->name('barang.transaksi_masuk');
    Route::get('/add',[TransaksiMasukController::class, 'add'])->name('barang.transaksi_masuk.add');
    Route::post('/post',[TransaksiMasukController::class, 'post'])->name('barang.transaksi_masuk.post');
    Route::get('/{id}/edit',[TransaksiMasukController::class, 'edit'])->name('barang.transaksi_masuk.edit');
    Route::patch('{id}/update/',[TransaksiMasukController::class, 'update'])->name('barang.transaksi_masuk.update');
    Route::delete('/{id}/delete/',[TransaksiMasukController::class, 'delete'])->name('barang.transaksi_masuk.delete');
    Route::get('/cari_barang',[TransaksiMasukController::class, 'cariBarang'])->name('barang.transaksi_masuk.cari_barang');
});

Route::group(['prefix'  => 'transaksi_barang_keluar/'],function(){
    Route::get('/',[TransaksiKeluarController::class, 'index'])->name('barang.transaksi_keluar');
    Route::get('/add',[TransaksiKeluarController::class, 'add'])->name('barang.transaksi_keluar.add');
    Route::post('/post',[TransaksiKeluarController::class, 'post'])->name('barang.transaksi_keluar.post');
    Route::get('/{id}/edit',[TransaksiKeluarController::class, 'edit'])->name('barang.transaksi_keluar.edit');
    Route::patch('{id}/update/',[TransaksiKeluarController::class, 'update'])->name('barang.transaksi_keluar.update');
    Route::delete('/{id}/delete/',[TransaksiKeluarController::class, 'delete'])->name('barang.transaksi_keluar.delete');
    Route::get('/cari_barang',[TransaksiKeluarController::class, 'cariBarang'])->name('barang.transaksi_keluar.cari_barang');
});

Route::group(['prefix'  => 'transaksi_peminjaman/'],function(){
    Route::get('/',[PeminjamanController::class, 'index'])->name('barang.peminjaman');
    Route::get('/add',[PeminjamanController::class, 'add'])->name('barang.peminjaman.add');
    Route::post('/post',[PeminjamanController::class, 'post'])->name('barang.peminjaman.post');
    Route::get('/{id}/edit',[PeminjamanController::class, 'edit'])->name('barang.peminjaman.edit');
    Route::patch('{id}/update/',[PeminjamanController::class, 'update'])->name('barang.peminjaman.update');
    Route::delete('/{id}/delete/',[PeminjamanController::class, 'delete'])->name('barang.peminjaman.delete');
    Route::get('/cari_barang',[PeminjamanController::class, 'cariBarang'])->name('barang.peminjaman.cari_barang');
});

Route::group(['prefix'  => 'laporan/'],function(){
    Route::get('/laporan_barang',[LaporanController::class, 'laporanBarang'])->name('laporan.barang');
    Route::get('/laporan_barang_masuk',[LaporanController::class, 'laporanBarangMasuk'])->name('laporan.masuk');
    Route::get('/laporan_barang_keluar',[LaporanController::class, 'laporanBarangKeluar'])->name('laporan.keluar');
    Route::get('/laporan_peminjaman',[LaporanController::class, 'laporanPeminjaman'])->name('laporan.peminjaman');

    Route::post('/cari_laporan_barang_masuk',[LaporanController::class, 'cariMasuk'])->name('laporan.cari_masuk');
    Route::post('/cari_laporan_barang_keluar',[LaporanController::class, 'cariKeluar'])->name('laporan.cari_keluar');
    Route::post('/cari_laporan_peminjaman',[LaporanController::class, 'cariPinjam'])->name('laporan.cari_pinjam');
});
