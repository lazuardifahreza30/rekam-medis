<?php

use App\Http\Controllers\SignInController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\TenagaMedisController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\KunjunganController;

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
Route::get('/signin', [SignInController::class, 'index']);
Route::get('/registrasi', [SignInController::class, 'registrasi']);
Route::get('/ganti-password', [SignInController::class, 'gantiPassword']);
Route::post('/signin/periksaAkun', [SignInController::class, 'periksaAkun']);
Route::post('/signin/login', [SignInController::class, 'login']);
Route::get('/signin/logout', [SignInController::class, 'logout']);

Route::get('/', [DashboardController::class, 'index']);
Route::post('/data', [DashboardController::class, 'data']);

Route::get('/pengaturan', [SettingController::class, 'index']);
Route::post('/pengaturan/data', [SettingController::class, 'data']);
Route::post('/pengaturan/dataPribadi', [SettingController::class, 'dataPribadi']);
Route::post('/pengaturan/getDetail', [SettingController::class, 'getDetail']);

Route::get('/dokter', [DokterController::class, 'index']);
Route::post('/dokter/getData', [DokterController::class, 'getData']);
Route::post('/dokter/data', [DokterController::class, 'data']);
Route::post('/dokter/create', [DokterController::class, 'create']);
Route::delete('/dokter/hapus', [DokterController::class, 'hapus']);

Route::get('/tenaga-medis', [TenagaMedisController::class, 'index']);
Route::post('/tenaga-medis/getData', [TenagaMedisController::class, 'getData']);
Route::post('/tenaga-medis/data', [TenagaMedisController::class, 'data']);
Route::post('/tenaga-medis/create', [TenagaMedisController::class, 'create']);
Route::delete('/tenaga-medis/hapus', [TenagaMedisController::class, 'hapus']);

Route::get('/pasien', [PasienController::class, 'index']);
Route::post('/pasien/getData', [PasienController::class, 'getData']);
Route::post('/pasien/data', [PasienController::class, 'data']);
Route::post('/pasien/create', [PasienController::class, 'create']);
Route::delete('/pasien/hapus', [PasienController::class, 'hapus']);

Route::get('/pengguna', [PenggunaController::class, 'index']);
Route::post('/pengguna/getData', [PenggunaController::class, 'getData']);
Route::post('/pengguna/data', [PenggunaController::class, 'data']);
Route::post('/pengguna/create', [PenggunaController::class, 'create']);
Route::delete('/pengguna/hapus', [PenggunaController::class, 'hapus']);

Route::get('/kunjungan', [KunjunganController::class, 'index']);
Route::post('/kunjungan/data', [KunjunganController::class, 'data']);
Route::post('/kunjungan/dataDokter', [KunjunganController::class, 'dataDokter']);
Route::post('/kunjungan/getData', [KunjunganController::class, 'getData']);
Route::post('/kunjungan/create', [KunjunganController::class, 'create']);
Route::delete('/kunjungan/hapus', [KunjunganController::class, 'hapus']);
