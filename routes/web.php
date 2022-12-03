<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JenisSuaraController;
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
Route::get('/pengguna', [UsersController::class, 'index']);

// Master Jenis Suara
Route::prefix('/jenis-suara')->group(function () {
    Route::get('/', [JenisSuaraController::class, 'index']);
    Route::post('/get-by-id', [JenisSuaraController::class, 'getById']);
    Route::post('/tambah', [JenisSuaraController::class, 'create']);
    Route::post('/ubah', [JenisSuaraController::class, 'update']);
    Route::get('/hapus/{id}', [JenisSuaraController::class, 'delete']);
});
