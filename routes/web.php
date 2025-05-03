<?php

use App\Models\Kamar;
use App\Models\Masukan;
use App\Models\Rekening;
use App\Models\Pemesanan;
use App\Models\Testimoni;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AktorController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\MasukanController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\PembayaranController;

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
    return view('welcome');
});

Route::group(['middleware' => ['auth','CheckRole:Pelanggan']],function(){
    Route::get('/carikamar/{namakamar}/{id}',[KamarController::class,'lihatkategoripelanggan']);
    Route::get('/pelanggan/{id}',[KamarController::class,'index']);
    Route::post('/savemasukan', [MasukanController::class, 'save']);
    Route::get('/kamarpelanggan',[KamarController::class,'tampilsemua']);
    Route::get('/lihatkamar/{nama}/{id}', [KamarController::class, 'detailkamarnama']);
    Route::post('/checketersediaan2', [KamarController::class, 'ceketersediaan2']);
    Route::get('/resetketersediaan/{id}', [KamarController::class, 'resetceketersediaan']);
    Route::post('/checketersediaan', [KamarController::class, 'ceketersediaan']);
    Route::get('/lihatprofil/{id}', [AktorController::class, 'tampil']);
    Route::put('/simpanprofil/{id}', [AktorController::class, 'update']);
    Route::post('/pesankamarpelanggan', [PemesananController::class, 'store']);
    Route::get('/pesananpelanggan/{id}', [PemesananController::class, 'show']);
    Route::get('/batalpemesanan/{id}', [PemesananController::class, 'destroy']);
    Route::post('/validasihapuspemesanan', [PembayaranController::class, 'validasihapuspemesanan']);
    Route::get('/detailkonfirmasipembayaran/{id}', [PemesananController::class, 'lihat']);
    Route::get('/lihatdetailpemesanan/{id}', [PemesananController::class, 'lihat']);
    Route::post('/bayaronlinepelanggan/{id}', [PembayaranController::class, 'store']);
    Route::post('/bayarofflinepelanggan/{id}', [PembayaranController::class, 'store']);
    Route::post('/testimonipelanggan', [TestimoniController::class, 'store']);
});

Route::group(['middleware' => ['auth','CheckRole:Admin']],function(){
    Route::get('/homeadmin', [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/kamar/{status}',[KamarController::class,'kamar'])->name('kamar');
    Route::post('/tambahjeniskamar',[KamarController::class,'store']);
    Route::get('/admineditkamar/{status}/{id}',[KamarController::class,'show'])->name('admin.editkamar');
    Route::put('/updatejeniskamar/{id}',[KamarController::class,'update']);
    Route::get('/adminhapuskamar/{id}',[KamarController::class,'destroy']);
    Route::get('/antrian',[PemesananController::class,'lihatpemesananadmin'])->name('lihatpemesananadmin');
    Route::get('/konfirmasibayaradmin',[PemesananController::class,'konfirmasibayar'])->name('konfirmasibayar');
    Route::get('/lihatpemesananaktifadmin',[PemesananController::class,'lihatpemesananaktifadmin'])->name('lihatpemesananaktifadmin');
    Route::get('/pelanggancheckinadmin',[PemesananController::class,'lihatpelanggansedangcheckinadmin'])->name('lihatpelanggancheckinadmin');
    Route::get('/validasibayaradmin/{id}',[PemesananController::class,'validasibayar']);
    Route::get('/validasicheckpelangganadmin/{id}',[PemesananController::class,'validasicheckpelangganadmin']);
    Route::get('/fixkonfirmasiadmin/{id}',[PemesananController::class,'fixkonfirmasi']);
    Route::post('/validasicheckoutpelangganadmin',[PemesananController::class,'validasicheckoutpelangganadmin']);
    Route::get('/konfirmasibayarofflineadmin',[PembayaranController::class,'lihatkonfirmasioffline']);
    Route::post('/validasipembayaranoffline', [PembayaranController::class, 'validasipembayaranoffline']);
    Route::post('/validasihapuspembayaranoffline', [PembayaranController::class, 'validasihapuspembayaranoffline']);
    Route::get('/validasihapuspesananadmin/{id}', [PembayaranController::class, 'validasihapuspesananadmin']);
    Route::get('/detailpemesananantrian/{id}', [PemesananController::class, 'lihatsemua']);
    Route::post('/validasipembayaranfulldpofflinecheckin', [PembayaranController::class, 'validasipembayaranfulldpofflinecheckin']);
    Route::get('/laporanadmin',[PemesananController::class,'laporanadmin'])->name('laporanadmin');
    Route::get('/cetak_laporan', [PemesananController::class,'cetak_laporan'])->name('cetak_laporan');


    Route::get('/akunpelanggan',[AktorController::class,'akuncustomer'])->name('akuncustomer');
    Route::get('/akunadmin',[AktorController::class,'akunadmin'])->name('akunadmin');
    Route::post('/tambah_akun', [AktorController::class,'tambah_akun'])->name('tambah_akun');
    Route::get('/akun/{id}/edit', [AktorController::class,'update_akun'])->name('update_akun');
    Route::post('/akun/{id}/update_akun', [AktorController::class,'edit_akun'])->name('edit_akun');
    Route::get('/akun/{id}/delete', [AktorController::class,'delete_akun'])->name('delete_akun');

    Route::get('/daftar_anggota', [AnggotaController::class,'daftar_anggota'])->name('daftar_anggota');
    Route::post('/tambah_anggota', [AnggotaController::class,'tambah_anggota'])->name('tambah_anggota');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'update_anggota'])->name('update_anggota');
    Route::post('/anggota/{id}/update_anggota', [AnggotaController::class, 'edit_anggota'])->name('edit_anggota');
    Route::get('/anggota/{id}/delete', [AnggotaController::class, 'delete_anggota'])->name('delete_anggota');

    Route::get('/daftar_pengurus', [PengurusController::class,'daftar_pengurus'])->name('daftar_pengurus');
    Route::post('/tambah_pengurus', [PengurusController::class,'tambah_pengurus'])->name('tambah_pengurus');
    Route::get('/pengurus/{id}/edit', [PengurusController::class, 'update_pengurus'])->name('update_pengurus');
    Route::post('/pengurus/{id}/update_pengurus', [PengurusController::class, 'edit_pengurus'])->name('edit_pengurus');
    Route::get('/pengurus/{id}/delete', [PengurusController::class, 'delete_pengurus'])->name('delete_pengurus');

    Route::get('/adminmasukan',[MasukanController::class,'masukan'])->name('masukan');

    Route::get('/testimoni',[TestimoniController::class,'testimoni'])->name('testimoni');

    Route::get('/daftar_pembayaran', [RekeningController::class,'daftar_pembayaran'])->name('daftar_pembayaran');
    Route::post('/tambah_pembayaran', [RekeningController::class,'tambah_pembayaran'])->name('tambah_pembayaran');
    Route::get('/pembayaran/{id}/edit', [RekeningController::class, 'update_pembayaran'])->name('update_pembayaran');
    Route::post('/pembayaran/{id}/update_pembayaran', [RekeningController::class, 'edit_pembayaran'])->name('edit_pembayaran');
    Route::get('/pembayaran/{id}/delete', [RekeningController::class, 'delete_pembayaran'])->name('delete_pembayaran');
});

Route::post('/simpanmasukan', [MasukanController::class, 'store']);
Route::post('/checketersediaanhome', [KamarController::class, 'ceketersediaan3']);
Route::get('/carikamarhome/{namakamar}',[KamarController::class,'lihatkategori']);
Route::get('/home',[KamarController::class,'tampil']);
Route::post('/login',[AktorController::class,'login'])->name('login');
Route::get('/logout',[AktorController::class,'logout'])->name('logout');
Route::post('/daftarpelanggan',[AktorController::class,'store']);
Route::get('/resetketersediaan', [KamarController::class, 'resetceketersediaan2']);

Route::get('/test',[TestimoniController::class,'test']);


// Route::view('/homeadmin', 'admin.homeadmin');
// Route::view('/profilpelanggan', 'profilpelanggan');
// Route::view('/homess', 'homepage');
// Route::view('/pesankamarpelanggan', 'halamanpesankamarpelanggan');
// Route::view('/pemesananpelanggan', 'pemesananpelanggan');
// Route::view('/pembayaranpelanggan', 'pembayaranpelanggan');
// Route::view('/detailpemesananpelanggan', 'detailpemesananpelanggan');
// Route::view('/detailpemesananpelanggan2', 'detailpemesananpelanggan2');
// Route::view('/detailpemesananpelanggan3', 'detailpemesananpelanggan3');
// Route::view('/detailpemesananpelanggan4', 'detailpemesananpelanggan4');
// Route::view('/detailpemesananpelanggan5', 'detailpemesananpelanggan5');
// Route::view('/home', 'homepage');

