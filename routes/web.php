<?php

use App\Http\Controllers\SignInController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\TenagaMedisController;
use App\Http\Controllers\PasienController;

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

Route::get('/', [DashboardController::class, 'index']);

Route::get('/dokter', [DokterController::class, 'index']);
Route::get('/dokter/getData', [DokterController::class, 'getData']);
Route::post('/dokter/data', [DokterController::class, 'data']);
Route::post('/dokter/create', [DokterController::class, 'create']);
Route::post('/dokter/hapus', [DokterController::class, 'hapus']);

Route::get('/tenaga-medis', [TenagaMedisController::class, 'index']);
Route::get('/tenaga-medis/getData', [TenagaMedisController::class, 'getData']);
Route::post('/tenaga-medis/data', [TenagaMedisController::class, 'data']);
Route::post('/tenaga-medis/create', [TenagaMedisController::class, 'create']);
Route::post('/tenaga-medis/hapus', [TenagaMedisController::class, 'hapus']);

Route::get('/pasien', [PasienController::class, 'index']);
Route::get('/pasien/getData', [PasienController::class, 'getData']);
Route::post('/pasien/data', [PasienController::class, 'data']);
Route::post('/pasien/create', [PasienController::class, 'create']);
Route::post('/pasien/hapus', [PasienController::class, 'hapus']);

Route::get('/pengguna', [PenggunaController::class, 'index']);
Route::get('/pengguna/getData', [PenggunaController::class, 'getData']);
Route::post('/pengguna/data', [PenggunaController::class, 'data']);
Route::post('/pengguna/create', [PenggunaController::class, 'create']);
Route::post('/pengguna/hapus', [PenggunaController::class, 'hapus']);
