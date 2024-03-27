<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pasien\PasienController;
use App\Http\Controllers\Pasien\KonsultasiController as KonsultasiPasienController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PoliController as AdminPoliController;
use App\Http\Controllers\Admin\DokterController as AdminDokterController;
use App\Http\Controllers\Dokter\JadwalPraktikDokterController;
use Illuminate\Support\Facades\Auth;

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


//HOMEPAGE
Route::get('/', function () {
    return view('homepage');
});
Route::get('login', [AuthController::class, 'login']);
Route::get('register', function () {
    return view('register');
});

Route::post('postlogin', [AuthController::class, 'postlogin']);
Route::post('postregister', [AuthController::class, 'postregister']);
Route::group(['middleware' => ['web']], function () {
    Route::get('login-google/callback', [AuthController::class, 'handleGoogleCallback']);
    Route::get('login-google', [AuthController::class, 'handleGoogleCallback']);
});
Route::get('login-google-auth', [AuthController::class, 'redirectToProvider']);
    Route::get('login-google-auth/callback', [AuthController::class, 'handleProviderCallback']);

Route::get('logout', [AuthController::class, 'logout']);


Route::middleware(['role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('dashboard', AdminDashboardController::class);
        Route::resource('poli', AdminPoliController::class);
        Route::resource('dokter', AdminDokterController::class);
        Route::post('dokter/update/{id}', [AdminDokterController::class, 'updates']);
        Route::get('dokter/hapus/{id}', [AdminDokterController::class, 'destroy']);
    });
});


Route::middleware(['role:pasien'])->group(function () {
    Route::prefix('pasien')->group(function () {
        Route::get('/dashboard', function () {
            return view('pasien.dashboard');
        });
        Route::get('profil-pasien', [AuthController::class, 'profil_pasien']);
        Route::post('profil_pasien_update/{id}', [AuthController::class, 'profil_pasien_update']);

        Route::get('konsultasi',[KonsultasiPasienController::class,'index']);
    });
});


Route::middleware(['role:dokter'])->group(function () {
    Route::prefix('dokter')->group(function () {
        Route::get('/dashboard', function () {
            return view('dokter.dashboard');
        });

        Route::get('profil-dokter', [AuthController::class, 'profil_dokter']);
        Route::post('profil_dokter_update/{id}', [AuthController::class, 'profil_dokter_update']);
    });
});


Route::get('/pemesanan', function () {
    return view('pasien.pemesanan');
});

Route::post('proses-pemesanan', [PasienController::class, 'prosesbooking']);
Route::get('pemesanan-pending', [PasienController::class, 'bookingpending'])->name('pemesanan-pending');
Route::get('pemesanan-cancel/{id}', [PasienController::class, 'bookingcancel'])->name('pemesanan-cancel');


    Route::resource('dokter/jadwal_praktiks', JadwalPraktikDokterController::class);
    Route::post('dokter/jadwal_praktik/update/{id}', [JadwalPraktikDokterController::class, 'updates']);
    Route::get('dokter/jadwal_praktik/{id_dokter}', [JadwalPraktikDokterController::class, 'index_jadwal']);
    Route::get('dokter/jadwal_praktik/{id_dokter}', [JadwalPraktikDokterController::class, 'index_jadwal']);
    Route::get('dokter/jadwal_praktik/create/{id}', [JadwalPraktikDokterController::class, 'create']);
    Route::get('dokter/jadwal_praktik/update/{id}', [JadwalPraktikDokterController::class, 'updates']);
    Route::get('dokter/jadwal_praktik/hapus/{id}', [JadwalPraktikDokterController::class, 'destroy']);

