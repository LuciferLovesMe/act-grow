<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenilaianLembagaController;
use App\Http\Controllers\PermintaanSertifikasiController;
use App\Http\Controllers\ProfileController;
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
Route::get('test-cek', function(){
    return view('penilaian-lembaga.add');
});

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/detail-lembaga', [HomeController::class, 'index'])->name('detail-lembaga');
Route::get('/profil-lembaga/{id}', [HomeController::class, 'profilLembaga'])->name('profil-lembaga');
Route::post('/update-verif-lembaga', [HomeController::class, 'updateVerifLembaga'])->name('update-verif-lembaga');
Route::get('/download-bukti-verif-lembaga/{id}', [HomeController::class, 'downloadbuktiVerifLembaga'])->name('download-bukti-verif-lembaga');

Route::prefix('/artikel')->group(function() {
    Route::get('/list-report', [ArtikelController::class, 'listReport'])->name('list-report-artikel');
    Route::post('/confirm-report', [ArtikelController::class, 'confirmReport'])->name('confirm-report');
    Route::post('/report', [ArtikelController::class, 'report'])->name('report-artikel');
});

Route::prefix('/penilaian')->group(function() {
    Route::post('/post', [SertifikasiLembagaController::class, 'postPenilaian'])->name('post-penilaian');
    Route::post('/ubah', [SertifikasiLembagaController::class, 'ubahPenilaian'])->name('ubah-penilaian');
    Route::post('/hapus-penilaian/{id}', [SertifikasiLembagaController::class, 'hapusPenilaian'])->name('hapus-penilaian');
    Route::post('/post-lembaga', [SertifikasiLembagaController::class, 'postLembaga'])->name('post-lembaga');
    Route::post('/ubah-lembaga', [SertifikasiLembagaController::class, 'ubahBalasanLembaga'])->name('ubah-lembaga');
    Route::post('/hapus-lembaga/{id}', [SertifikasiLembagaController::class, 'hapusBalasanLembaga'])->name('hapus-lembaga');
});

Route::prefix('/profile')
    ->name('profile.')
    ->group(function() {
        Route::get('/', [ProfileController::class, 'show'])->name('index');
        Route::post('/post-lembaga/{id}', [ProfileController::class, 'postLembaga'])->name('post-lembaga');
        Route::post('/post-petani/{id}', [ProfileController::class, 'postPetani'])->name('post-petani');
        Route::get('/show', [ProfileController::class, 'showProfile'])->name('show');
        Route::get('/lihat-sertifikat', [ProfileController::class, 'lihatSertifikat'])->name('lihat-sertifikat');
});

// Route::middleware('auth')->group(function (){
    // Route Upload Berkas ketentuan permintaan sertifikasi (Petani)
    Route::get('/permintaan-sertifikasi/upload-ketentuan', [PermintaanSertifikasiController::class, 'uploadKetentuan'])->name('upload-ketentuan');
    // Route untuk melihat permintaan sertifikasi (Petani)
    Route::get('/permintaan-sertifikasi/lihat-permintaan', [PermintaanSertifikasiController::class, 'lihatPermintaan'])->name('lihat-permintaaan');

    Route::resource('sertifikasi-lembaga', SertifikasiLembagaController::class);
    // Route Permintaan Sertifikasi
    Route::resource('permintaan-sertifikasi', PermintaanSertifikasiController::class);
    // Route Penilaian Lembaga
    Route::resource('penilaian-lembaga', PenilaianLembagaController::class);
    // Route Artikel
    Route::resource('artikel', ArtikelController::class);

    Route::prefix('/sertifikasi-lembaga')->group(function() {
        // Show Detail sertifikasi
        Route::get('/detail-sertifikasi/{id}', [SertifikasiLembagaController::class, 'showDetailSertifikasi'])->name('show-detail-sertifikasi');
        // Permintaan Sertfikasi Index
        Route::get('/show-permintaan-sertifikasi/{id}', [SertifikasiLembagaController::class, 'showPermintaanSertifikasi'])->name('show-permintaan-sertifikasi');
        // Detail Permintaan Sertifikasi
        Route::get('/detail-permintaan-sertifikasi/{id}', [SertifikasiLembagaController::class, 'detailPermintaanSertifikasi'])->name('detail-permintaan-sertifikasi');
        // Download Ketentuan yang telah diupload petani
        Route::get('/download-ketentuan-petani/{id}', [SertifikasiLembagaController::class, 'downloadKetentuanPetani'])->name('download-ketentuan-petani');
        // Ganti Status Permintaan
        Route::post('/ganti-status', [SertifikasiLembagaController::class, 'gantiStatus'])->name('ganti-status');
        // Upload Sertifikat
        Route::post('/upload-sertifikat', [SertifikasiLembagaController::class, 'uploadSertifikat'])->name('upload-sertifikat');
        // Lihat Sertifikat
        Route::get('/download-sertifikat/{id}', [SertifikasiLembagaController::class, 'downloadSertifikat'])->name('download-sertifikat');
    });

    // Route download ketentuan sertifikasi
    Route::get('/download-sertifikasi/{id}', [SertifikasiLembagaController::class, 'downloadKetentuan'])->name('download-ketentuan-sertifikasi');
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
