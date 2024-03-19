<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Pasien\PasienController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PoliController as AdminPoliController;
use App\Http\Controllers\Admin\DokterController as AdminDokterController;


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
Route::post('postlogin', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout']);


Route::prefix('admin')->group(function () {
    Route::resource('dashboard', AdminDashboardController::class);
    Route::resource('poli', AdminPoliController::class);
    Route::resource('dokter', AdminDokterController::class);
});

Route::prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    });
});


Route::prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    });
});

Route::get('/pemesanan', function () {
    return view('pasien.pemesanan');
});

Route::post('proses-pemesanan', [PasienController::class, 'prosesbooking']);

//LOGIN
// Route::get('/login', function () {
//     return view('login');
// });

