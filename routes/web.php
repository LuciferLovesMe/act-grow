<?php

use App\Http\Controllers\PermintaanSertifikasiController;
use App\Http\Controllers\SertifikasiLembagaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layouts.template');
});

// Route::middleware('auth')->group(function (){
    // Route Upload Berkas ketentuan permintaan sertifikasi (Petani)
    Route::get('/permintaan-sertifikasi/upload-ketentuan', [PermintaanSertifikasiController::class, 'uploadKetentuan'])->name('upload-ketentuan');
    // Route untuk melihat permintaan sertifikasi (Petani)
    Route::get('/permintaan-sertifikasi/lihat-permintaan', [PermintaanSertifikasiController::class, 'lihatPermintaan'])->name('lihat-permintaaan');

    Route::resource('sertifikasi-lembaga', SertifikasiLembagaController::class);
    // Route Permintaan Sertifikasi
    Route::resource('permintaan-sertifikasi', PermintaanSertifikasiController::class);

    // Show Detail sertifikasi
    Route::get('/sertifikasi-lembaga/detail-sertifikasi/{id}', [SertifikasiLembagaController::class, 'showDetailSertifikasi'])->name('show-detail-sertifikasi');
    // Route download ketentuan sertifikasi
    Route::get('/download-sertifikasi/{id}', [SertifikasiLembagaController::class, 'downloadKetentuan'])->name('download-ketentuan-sertifikasi');
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
