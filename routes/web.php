<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware('guest.jamaah');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register')
    ->middleware('guest.jamaah');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post');


/*
|--------------------------------------------------------------------------
| Authenticated Jamaah Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth.jamaah')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/riwayat/donasi', [DashboardController::class, 'riwayatDonasi'])
        ->name('riwayat.donasi');

    Route::get('/riwayat/kegiatan', [DashboardController::class, 'riwayatKegiatan'])
        ->name('riwayat.kegiatan');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/profile', [AuthController::class, 'profile'])
        ->name('profile');
        
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])
        ->name('profile.update');

});
