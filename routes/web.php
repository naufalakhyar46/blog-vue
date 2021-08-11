<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Portal\Home\HomeController;
use App\Http\Controllers\Portal\Detail\DetailController;
use App\Http\Controllers\Portal\ListBlog\ListController;

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
// Route::get('/', function() {
//     dd(Session::get('id'));
//     return view('welcome');
// });

Route::get('/', [HomeController::class,'index']);
Route::get('blog', [ListController::class,'index']);
Route::get('blog/detail-blog/{slug}', [DetailController::class,'index']);

Route::get('/login', [AuthController::class,'login'])->name('login');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');
Route::post('/login', [AuthController::class,'_proses_login'])->name('login.api');

Route::get('/register', [AuthController::class,'regis'])->name('register');
Route::get('/reset', [AuthController::class,'reset_pass'])->name('reset');
Route::get('/confirm-reset/{token}', [AuthController::class,'view_confirm'])->name('confirm-reset');
Route::get('/confirm-reset', function () {
    return redirect()->route('login');
});

Route::post('confirm-reset', [AuthController::class,'login'])->name('confirm-reset');
// Route::post('login', [AuthController::class,'_proses_login'])->name('login');
Route::post('register', [AuthController::class,'register'])->name('register');
Route::post('reset', [AuthController::class,'reset'])->name('reset');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::get('kirim-verify/{id}', [AuthController::class,'kirimVerifyEmail'])->name('kirim-verify');
Route::get('verify-email/{id}', [AuthController::class,'verifikasi_email'])->name('verifikasi_email');

Route::get('/panel/{any}', function() {
    return view('layouts.panel.blueprint');
})->where('any','.*');
