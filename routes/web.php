<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DataLokasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViewMapController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login_view'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('loginpost');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/get-marker', [ViewMapController::class, 'getMarker']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::resource('/data-lokasi', DataLokasiController::class);
    Route::resource('/data-anggota', AnggotaController::class);
    Route::get('/peta', [ViewMapController::class, 'index'])->name('peta');
    Route::put('/update-profile/{id}', [ProfileController::class, 'updateProfil'])->name('updateProfile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
