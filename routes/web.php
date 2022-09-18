<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\c_utama;
use App\Http\Controllers\c_login;
use App\Http\Controllers\c_offline;
use App\Http\Controllers\c_terima;
use App\Http\Controllers\c_cetak;

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

Route::get('/login',[c_login::class, 'login'])->name("login");
Route::get('/',[c_utama::class, 'index']);
Route::post('/login_post',[c_login::class, 'login_post'])->name("login_post");
Route::get('/offline',[c_offline::class, 'index']);
Route::get('/offline1/{id}/{st}',[c_offline::class, 'form1']);
Route::post('/simpan1',[c_offline::class, 'simpan1'])->name("simpan1");
Route::post('/ambil_kab',[c_offline::class, 'ambil_kab'])->name("ambil_kab");
Route::post('/ambil_kec',[c_offline::class, 'ambil_kec'])->name("ambil_kec");
Route::post('/ambil_desa',[c_offline::class, 'ambil_desa'])->name("ambil_desa");
Route::post('/simpan2',[c_offline::class, 'simpan2'])->name("simpan2");
Route::get('/offline2/{id}/{st}',[c_offline::class, 'form2']);
Route::post('/batal',[c_offline::class, 'batal'])->name("batal");
Route::post('/simpan3',[c_offline::class, 'simpan3'])->name("simpan3");
Route::post('/simpan4',[c_offline::class, 'simpan4'])->name("simpan4");
Route::get('/offline3/{id}/{st}',[c_offline::class, 'form3']);
Route::get('/offline4/{id}/{st}',[c_offline::class, 'form4']);
Route::post('/mahrom_data',[c_offline::class, 'mahrom_data'])->name("mahrom_data");
Route::post('/mahrom_simpan',[c_offline::class, 'mahrom_simpan'])->name("mahrom_simpan");
Route::post('/mahrom_hapus',[c_offline::class, 'mahrom_hapus'])->name("mahrom_hapus");
// Route::post('/mahrom_foto',[c_offline::class, 'mahrom_foto'])->name("mahrom_foto");
Route::post('/offline_selesai',[c_offline::class, 'offline_selesai'])->name("offline_selesai");
Route::post('/person_data',[c_offline::class, 'person_data'])->name("person_data");
Route::get('/upload/{id}',[c_offline::class, 'upload']);
Route::post('/upload_simpan',[c_offline::class, 'upload_simpan'])->name("upload_simpan");
Route::get('/detail/{id}',[c_offline::class, 'detail']);
Route::get('/logout_adm',[c_login::class, 'logout']);

// NO Registrasi
Route::get('/terima',[c_terima::class, 'index']);
Route::post('/cek_regris',[c_terima::class, 'cek_regris'])->name("cek_regris");
Route::get('/terima_detail/{id}/{o}',[c_terima::class, 'detail']);
Route::post('/terima_simpan',[c_terima::class, 'terima_simpan'])->name("terima_simpan");

// Qr Code
Route::get('/terima_qrcode',[c_terima::class, 'terima_qrcode']);



Route::get('/print_daftar/{id}/{o}',[c_offline::class, 'print_daftar']);
Route::get('/formulir/{id}',[c_offline::class, 'formulir']);
Route::get('/print_surat_santri/{id}',[c_offline::class, 'print_surat_santri']);
Route::get('/print_surat_ortu/{id}',[c_offline::class, 'print_surat_ortu']);

Route::get('/cetak_siswa',[c_cetak::class, 'siswa']);
Route::get('/cetak_mahrom',[c_cetak::class, 'mahrom']);
Route::get('/cetak_mahrom_all',[c_cetak::class, 'mahrom_all']);
Route::post('/siswa_person_data',[c_cetak::class, 'person_data'])->name("siswa_person_data");
Route::get('/cetak_siswa_print/{status}/{tahun}',[c_cetak::class, 'siswa_print']);
Route::post('/cek_data_siswa',[c_cetak::class, 'cek'])->name("cek_data_siswa");
Route::get('/cetak_semua_mahrom/{hal}/{batas}/{file}',[c_cetak::class, 'mahrom_all_print']);
Route::get('/cetak_print_mahrom/{id}',[c_cetak::class, 'mahrom_print']);

Route::get('/cetak_santri',[c_cetak::class, 'santri']);
Route::get('/cetak_santri_print/{status}/{tahun}',[c_cetak::class, 'santri_print']);