<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Pasien\PasienController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PoliController as AdminPoliController;
use App\Http\Controllers\Admin\DokterController as AdminDokterController;
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
Route::get('logout', [AuthController::class, 'logout']);


Route::middleware(['role:admin'])->group(function () {  
    Route::prefix('admin')->group(function () {
        Route::resource('dashboard', AdminDashboardController::class);
        Route::resource('poli', AdminPoliController::class);
        Route::resource('dokter', AdminDokterController::class);
        Route::post('dokter/update/{id}', [AdminDokterController::class,'updates']);
        Route::get('dokter/hapus/{id}', [AdminDokterController::class,'destroy']);
    });
});


Route::middleware(['role:pasien'])->group(function () {  
    Route::prefix('pasien')->group(function () {
        Route::get('/dashboard', function () {
            return view('pasien.dashboard');
        });
Route::get('profil-pasien', [AuthController::class, 'profil_pasien']);
Route::post('profil_pasien_update/{id}', [AuthController::class, 'profil_pasien_update']);


    });
});


Route::middleware(['role:dokter'])->group(function () {  
    Route::prefix('dokter')->group(function () {
        Route::get('/dashboard', function () {
            return view('dokter.dashboard');
        });
    });
});


Route::get('/pemesanan', function () {
    return view('pasien.pemesanan');
});

Route::post('proses-pemesanan', [PasienController::class, 'prosesbooking']);
Route::get('pemesanan-pending', [PasienController::class, 'bookingpending'])->name('pemesanan-pending');
Route::get('pemesanan-cancel/{id}', [PasienController::class, 'bookingcancel'])->name('pemesanan-cancel');

//LOGIN
// Route::get('/login', function () {
//     return view('login');
// });

