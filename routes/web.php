<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\PemainController;

Route::post('/daftar-tim', [TeamController::class, 'store'])->name('daftar.tim');
Route::get('/pemain', [PemainController::class, 'index'])->name('pemain.index');
Route::post('/pemain', [PemainController::class, 'store'])->name('pemain.store');
Route::delete('/pemain/{id}', [PemainController::class, 'destroy'])->name('pemain.destroy');
Route::get('/cetak-pengesahan/{id}', [TeamController::class, 'cetakPengesahan'])->name('cetak.pengesahan');
Route::get('/cetak-idcard/{id}', [TeamController::class, 'cetakIdCard'])->name('cetak.idcard');
// Route Official diarahkan ke PemainController
Route::post('/official', [PemainController::class, 'storeOfficial'])->name('official.store');
Route::delete('/official/{id}', [PemainController::class, 'destroyOfficial'])->name('official.destroy');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman Utama (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// RUTE KHUSUS ADMIN / PANITIA PUSAT
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin (Belum Login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    // Auth Admin (Sudah Login)
    Route::get('/teams/{id}', [AdminDashboardController::class, 'show'])->name('teams.show');
Route::post('/teams/{id}/verify', [AdminDashboardController::class, 'verify'])->name('teams.verify');
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// ==========================================
// RUTE PESERTA / MANAJER TIM (Bawaan Breeze/Jetstream/Auth)
// ==========================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/admin/players/{id}/verify', [App\Http\Controllers\Admin\DashboardController::class, 'verifyPlayer'])->name('admin.players.verify');
Route::get('/pemain', [App\Http\Controllers\PemainController::class, 'index'])->name('pemain.index');
Route::post('/pemain', [App\Http\Controllers\PemainController::class, 'store'])->name('pemain.store');
Route::post('/official', [App\Http\Controllers\OfficialController::class, 'store'])->name('official.store');
// Memuat rute autentikasi bawaan (login/register peserta)
require __DIR__.'/auth.php';