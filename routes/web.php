<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarHitamController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JenisSuaraController;
use App\Http\Controllers\DapilController;
use App\Http\Controllers\DataKeluargaController;
use App\Http\Controllers\DataKunjunganController;
use App\Http\Controllers\DataPengkhianatController;
use App\Http\Controllers\DataSimpatisanController;
use App\Http\Controllers\DataSuaraAbuController;
use App\Http\Controllers\DataUmumController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\PemilihJenisController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\SuaraAbuController;
use App\Http\Controllers\TimSuksesJenisController;
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
// Master Dapil
Route::group(['prefix' => 'dapil', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DapilController::class, 'index']);
    Route::post('/get-by-id', [DapilController::class, 'getById']);
    Route::post('/tambah', [DapilController::class, 'create']);
    Route::post('/ubah', [DapilController::class, 'update']);
    Route::get('/hapus/{id}', [DapilController::class, 'delete']);
});
// Master Kabupaten
Route::group(['prefix' => 'kabupaten', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [KabupatenController::class, 'index']);
    Route::post('/get-by-id', [KabupatenController::class, 'getById']);
    Route::post('/tambah', [KabupatenController::class, 'create']);
    Route::post('/ubah', [KabupatenController::class, 'update']);
    Route::get('/hapus/{id}', [KabupatenController::class, 'delete']);
});
// Master Kecamatan
Route::group(['prefix' => 'kecamatan', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [KecamatanController::class, 'index']);
    Route::post('/get-by-id', [KecamatanController::class, 'getById']);
    Route::post('/tambah', [KecamatanController::class, 'create']);
    Route::post('/ubah', [KecamatanController::class, 'update']);
    Route::get('/hapus/{id}', [KecamatanController::class, 'delete']);
});
// Master Desa
Route::group(['prefix' => 'desa', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [DesaController::class, 'index']);
    Route::post('/get-by-id', [DesaController::class, 'getById']);
    Route::post('/tambah', [DesaController::class, 'create']);
    Route::post('/ubah', [DesaController::class, 'update']);
    Route::get('/hapus/{id}', [DesaController::class, 'delete']);
});
// Master Tps
Route::group(['prefix' => 'tps', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [TpsController::class, 'index']);
    Route::post('/get-by-id', [TpsController::class, 'getById']);
    Route::post('/tambah', [TpsController::class, 'create']);
    Route::post('/ubah', [TpsController::class, 'update']);
    Route::get('/hapus/{id}', [TpsController::class, 'delete']);
});
// Master Jenis Suara
Route::group(['prefix' => 'jenis-suara', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [JenisSuaraController::class, 'index']);
    Route::post('/get-by-id', [JenisSuaraController::class, 'getById']);
    Route::post('/tambah', [JenisSuaraController::class, 'create']);
    Route::post('/ubah', [JenisSuaraController::class, 'update']);
    Route::get('/hapus/{id}', [JenisSuaraController::class, 'delete']);
});
// Master Jenis Pemilih
Route::group(['prefix' => 'jenis-pemilih', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [PemilihJenisController::class, 'index']);
    Route::post('/get-by-id', [PemilihJenisController::class, 'getById']);
    Route::post('/tambah', [PemilihJenisController::class, 'create']);
    Route::post('/ubah', [PemilihJenisController::class, 'update']);
    Route::get('/hapus/{id}', [PemilihJenisController::class, 'delete']);
});
// Master Suara Abu
Route::group(['prefix' => 'suara-abu', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [SuaraAbuController::class, 'index']);
    Route::post('/get-by-id', [SuaraAbuController::class, 'getById']);
    Route::post('/tambah', [SuaraAbuController::class, 'create']);
    Route::post('/ubah', [SuaraAbuController::class, 'update']);
    Route::get('/hapus/{id}', [SuaraAbuController::class, 'delete']);
});
// Master Jenis Tim Sukses
Route::group(['prefix' => 'jenis-tim-sukses', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [TimSuksesJenisController::class, 'index']);
    Route::post('/get-by-id', [TimSuksesJenisController::class, 'getById']);
    Route::post('/tambah', [TimSuksesJenisController::class, 'create']);
    Route::post('/ubah', [TimSuksesJenisController::class, 'update']);
    Route::get('/hapus/{id}', [TimSuksesJenisController::class, 'delete']);
});

// Data Umum
Route::group(['prefix' => 'data-umum', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [DataUmumController::class, 'index']);
    Route::post('/get-by-id', [DataUmumController::class, 'getById']);
    Route::post('/get-foto-by-id', [DataUmumController::class, 'getFotoById']);
    Route::post('/get-data-by-id', [DataUmumController::class, 'getDataById']);
    Route::post('/tambah', [DataUmumController::class, 'create']);
    Route::post('/ubah', [DataUmumController::class, 'update']);
    Route::get('/hapus/{id}', [DataUmumController::class, 'delete']);
});
// Data Kunjungan
Route::group(['prefix' => 'data-kunjungan', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{kec}', [DataKunjunganController::class, 'index']);
    Route::post('/get-penduduk', [DataKunjunganController::class, 'getPenduduk']);
    Route::post('/simpan-target', [DataKunjunganController::class, 'simpanTarget']);
});
// Data Keluarga
Route::group(['prefix' => 'data-keluarga', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [DataKeluargaController::class, 'index']);
    Route::post('/get-pemilih-by-desa', [DataKeluargaController::class, 'getPemilihByDesa']);
    Route::post('/ubah', [DataKeluargaController::class, 'update']);
    Route::get('/hapus/{id}', [DataKeluargaController::class, 'delete']);
});
// Data Simpatisan
Route::group(['prefix' => 'data-simpatisan', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [DataSimpatisanController::class, 'index']);
    Route::post('/get-pemilih-by-desa', [DataSimpatisanController::class, 'getPemilihByDesa']);
    Route::post('/ubah', [DataSimpatisanController::class, 'update']);
    Route::get('/hapus/{id}', [DataSimpatisanController::class, 'delete']);
});
// Data Pengkhianat
Route::group(['prefix' => 'data-pengkhianat', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [DataPengkhianatController::class, 'index']);
    Route::post('/get-pemilih-by-desa', [DataPengkhianatController::class, 'getPemilihByDesa']);
    Route::post('/ubah', [DataPengkhianatController::class, 'update']);
    Route::get('/hapus/{id}', [DataPengkhianatController::class, 'delete']);
});
// Daftar Hitam
Route::group(['prefix' => 'daftar-hitam', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [DaftarHitamController::class, 'index']);
    Route::post('/get-pemilih-by-desa', [DaftarHitamController::class, 'getPemilihByDesa']);
    Route::post('/ubah', [DaftarHitamController::class, 'update']);
    Route::get('/hapus/{id}', [DaftarHitamController::class, 'delete']);
});
// Data Suara Abu-abu
Route::group(['prefix' => 'data-suara-abu', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/{id}', [DataSuaraAbuController::class, 'index']);
    Route::post('/get-pemilih-by-desa', [DataSuaraAbuController::class, 'getPemilihByDesa']);
    Route::post('/ubah', [DataSuaraAbuController::class, 'update']);
    Route::get('/hapus/{id}', [DataSuaraAbuController::class, 'delete']);
});


// Dashboard Calon Legislatif
Route::group(['prefix' => 'dashboard-caleg', 'middleware' => ['auth', 'caleg']], function () {
    Route::get('/', [DashboardController::class, 'index2']);
    Route::get('/bar-chart-data/{dapil}', [dashboardController::class, 'barChartData']);
    Route::get('/data-kunjungan-per-kecamatan/{id}', [dashboardController::class, 'dataKunjunganPerKecamatan']);
    Route::get('data-pembagian-pemilih/{jenis}/{id}', [DashboardController::class, 'dataPembagianPemilih']);
    Route::get('list-pemilih/{id}', [DashboardController::class, 'listPemilih']);
});
