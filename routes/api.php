<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Panel\Blog\BlogController;
use App\Http\Controllers\Panel\Pengguna\PenggunaController;
use App\Http\Controllers\Panel\Konfigurasi\KonfigurasiController;

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

Route::post('/login', [AuthController::class,'_proses_login'])->name('login.api');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');
Route::prefix('/pengguna')->group(function(){
    Route::get('/', [PenggunaController::class,'index']);
    Route::post('/', [PenggunaController::class,'store']);
    Route::post('/{id}', [PenggunaController::class,'update']);
    Route::post('/profile/{id}', [PenggunaController::class,'profile']);
    Route::post('/change-pass/{id}', [PenggunaController::class,'change_pass']);
    Route::delete('/{id}', [PenggunaController::class,'destroy']);
    Route::get('/show/{id}', [PenggunaController::class,'show']);
});

Route::prefix('/blog')->group(function(){
    Route::get('/', [BlogController::class,'index']);
    Route::post('/', [BlogController::class,'store']);
    Route::post('/{id}', [BlogController::class,'update']);
    Route::delete('/{id}', [BlogController::class,'destroy']);
    Route::get('/show/{id}', [BlogController::class,'show']);
});

Route::prefix('/konfigurasi')->group(function(){
    Route::post('/update', [KonfigurasiController::class,'update']);
    Route::get('/show', [KonfigurasiController::class,'show']);
});
