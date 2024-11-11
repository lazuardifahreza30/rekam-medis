<?php

use Illuminate\Http\Request;

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


use App\Http\api\PendaftaranApi;
use App\Http\api\RequestDosenApi;
use App\Http\api\RequestMahasiswaApi;
use App\Http\api\UserApi;
use App\Http\api\LogbookApi;
use App\Http\api\PersyaratanApi;
use App\Http\api\RegisAkunApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/post', function () { 
//     dd('calon programmer handal ');
// });
Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();
});
    
// Route::group(['prefix' => 'user'], function() {
//     Route::get('/', [UsersController::class, 'index']);
//     Route::post('/create', [UsersControlller::class, 'create']);
// }); 

Route::get('/post', function () {
    dd('calon programmer handal ');
});

Route::group(['prefix' => 'pendaftaran'], function() {

  Route::get('/', [PendaftaranApi::class, 'index']);
  Route::post('/create', [PendaftaranApi::class, 'create']);
});

Route::group(['prefix' => 'request_mahasiswa'], function() {
    Route::get('/', [RequestMahasiswaApi::class, 'index']);
    Route::post('/create', [RequestMahasiswaApi::class, 'create']);
  });

  Route::group(['prefix' => 'request_dosen'], function() {
    Route::get('/', [RequestDosenApi::class, 'index']);
    Route::post('/create', [RequestDosenApi::class, 'create']);
  });

  Route::group(['prefix' => 'user'], function() {
    Route::get('/', [UserApi::class, 'index']);
    Route::post('/create', [UserApi::class, 'create']);
  });

Route::group(['prefix' => 'logbook'], function() {
  Route::get('/', [LogbookApi::class, 'index']);
  Route::post('/create', [LogbookApi::class, 'create']);
});

Route::group(['prefix' => 'regis_akun'], function() {
  Route::get('/', [RegisAkunApi::class, 'index']);
  Route::post('/create', [RegisAkunApi::class, 'create']);
});

Route::group(['prefix' => 'persyaratan'], function() {
  Route::get('/', [PersyaratanApi::class, 'index']);
  Route::post('/create', [PersyaratanApi::class, 'create']);
});