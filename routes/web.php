<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JenisSuaraController;
use App\Http\Controllers\DapilController;
use App\Http\Controllers\DataKunjunganController;
use App\Http\Controllers\DataUmumController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\SuaraAbuController;
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
// Dashboard
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/', [dashboardController::class, 'index']);
});

// Authntication
Route::prefix('/auth')->group(function () {
    Route::get('/daftar', [AuthController::class, 'daftar']);

    Route::get('/masuk', [AuthController::class, 'masuk']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

// Master Users
Route::group(['prefix' => 'pengguna', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::post('/get-by-id', [UsersController::class, 'getById']);
    Route::post('/get-foto-by-id', [UsersController::class, 'getFotoById']);
    Route::post('/tambah', [UsersController::class, 'create']);
    Route::post('/ubah', [UsersController::class, 'update']);
    Route::get('/hapus/{id}', [UsersController::class, 'delete']);
});
// Master Jenis Suara
Route::group(['prefix' => 'jenis-suara', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [JenisSuaraController::class, 'index']);
    Route::post('/get-by-id', [JenisSuaraController::class, 'getById']);
    Route::post('/tambah', [JenisSuaraController::class, 'create']);
    Route::post('/ubah', [JenisSuaraController::class, 'update']);
    Route::get('/hapus/{id}', [JenisSuaraController::class, 'delete']);
});
// Master Dapil
Route::group(['prefix' => 'dapil', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DapilController::class, 'index']);
    Route::post('/get-by-id', [DapilController::class, 'getById']);
    Route::post('/tambah', [DapilController::class, 'create']);
    Route::post('/ubah', [DapilController::class, 'update']);
    Route::get('/hapus/{id}', [DapilController::class, 'delete']);
});
// Master Kecamatan
Route::group(['prefix' => 'kecamatan', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [KecamatanController::class, 'index']);
    Route::post('/get-by-id', [KecamatanController::class, 'getById']);
    Route::post('/tambah', [KecamatanController::class, 'create']);
    Route::post('/ubah', [KecamatanController::class, 'update']);
    Route::get('/hapus/{id}', [KecamatanController::class, 'delete']);
});
// Master Desa
Route::group(['prefix' => 'desa', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DesaController::class, 'index']);
    Route::post('/get-by-id', [DesaController::class, 'getById']);
    Route::post('/tambah', [DesaController::class, 'create']);
    Route::post('/ubah', [DesaController::class, 'update']);
    Route::get('/hapus/{id}', [DesaController::class, 'delete']);
});
// Master Tps
Route::group(['prefix' => 'tps', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [TpsController::class, 'index']);
    Route::post('/get-by-id', [TpsController::class, 'getById']);
    Route::post('/tambah', [TpsController::class, 'create']);
    Route::post('/ubah', [TpsController::class, 'update']);
    Route::get('/hapus/{id}', [TpsController::class, 'delete']);
});
// Master Suara Abu
Route::group(['prefix' => 'suara-abu', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [SuaraAbuController::class, 'index']);
    Route::post('/get-by-id', [SuaraAbuController::class, 'getById']);
    Route::post('/tambah', [SuaraAbuController::class, 'create']);
    Route::post('/ubah', [SuaraAbuController::class, 'update']);
    Route::get('/hapus/{id}', [SuaraAbuController::class, 'delete']);
});

// Data Umum
Route::group(['prefix' => 'data-umum', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DataUmumController::class, 'index']);
    Route::post('/get-by-id', [DataUmumController::class, 'getById']);
    Route::post('/get-foto-by-id', [DataUmumController::class, 'getFotoById']);
    Route::post('/get-data-by-id', [DataUmumController::class, 'getDataById']);
    Route::post('/tambah', [DataUmumController::class, 'create']);
    Route::post('/ubah', [DataUmumController::class, 'update']);
    Route::get('/hapus/{id}', [DataUmumController::class, 'delete']);
});

// Data Kunjungan
Route::group(['prefix' => 'data-kunjungan', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DataKunjunganController::class, 'index']);
    Route::post('/get-penduduk', [DataKunjunganController::class, 'getPenduduk']);
    Route::post('/simpan-target', [DataKunjunganController::class, 'simpanTarget']);
});