<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JenisSuaraController;
use App\Http\Controllers\DapilController;
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
Route::get('/', [DashboardController::class, 'index']);

// Master Users
Route::prefix('/pengguna')->group(function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::post('/get-by-id', [UsersController::class, 'getById']);
    Route::post('/get-foto-by-id', [UsersController::class, 'getFotoById']);
    Route::post('/tambah', [UsersController::class, 'create']);
    Route::post('/ubah', [UsersController::class, 'update']);
    Route::get('/hapus/{id}', [UsersController::class, 'delete']);
});

// Master Jenis Suara
Route::prefix('/jenis-suara')->group(function () {
    Route::get('/', [JenisSuaraController::class, 'index']);
    Route::post('/get-by-id', [JenisSuaraController::class, 'getById']);
    Route::post('/tambah', [JenisSuaraController::class, 'create']);
    Route::post('/ubah', [JenisSuaraController::class, 'update']);
    Route::get('/hapus/{id}', [JenisSuaraController::class, 'delete']);
});

// Master Dapil
Route::prefix('/dapil')->group(function () {
    Route::get('/', [DapilController::class, 'index']);
    Route::post('/get-by-id', [DapilController::class, 'getById']);
    Route::post('/tambah', [DapilController::class, 'create']);
    Route::post('/ubah', [DapilController::class, 'update']);
    Route::get('/hapus/{id}', [DapilController::class, 'delete']);
});

// Master Kecamatan
Route::prefix('/kecamatan')->group(function () {
    Route::get('/', [KecamatanController::class, 'index']);
    Route::post('/get-by-id', [KecamatanController::class, 'getById']);
    Route::post('/tambah', [KecamatanController::class, 'create']);
    Route::post('/ubah', [KecamatanController::class, 'update']);
    Route::get('/hapus/{id}', [KecamatanController::class, 'delete']);
});

// Master Desa
Route::prefix('/desa')->group(function () {
    Route::get('/', [DesaController::class, 'index']);
    Route::post('/get-by-id', [DesaController::class, 'getById']);
    Route::post('/tambah', [DesaController::class, 'create']);
    Route::post('/ubah', [DesaController::class, 'update']);
    Route::get('/hapus/{id}', [DesaController::class, 'delete']);
});

// Master Tps
Route::prefix('/tps')->group(function () {
    Route::get('/', [TpsController::class, 'index']);
    Route::post('/get-by-id', [TpsController::class, 'getById']);
    Route::post('/tambah', [TpsController::class, 'create']);
    Route::post('/ubah', [TpsController::class, 'update']);
    Route::get('/hapus/{id}', [TpsController::class, 'delete']);
});

// Master Suara Abu
Route::prefix('/suara-abu')->group(function () {
    Route::get('/', [SuaraAbuController::class, 'index']);
    Route::post('/get-by-id', [SuaraAbuController::class, 'getById']);
    Route::post('/tambah', [SuaraAbuController::class, 'create']);
    Route::post('/ubah', [SuaraAbuController::class, 'update']);
    Route::get('/hapus/{id}', [SuaraAbuController::class, 'delete']);
});