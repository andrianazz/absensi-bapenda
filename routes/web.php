<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\UserController;

use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/auth', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//DATA THL
Route::get('/', function () {
    if (Auth::check() == false) {
        return redirect('/login');
    }

    $users = User::where('unit_kerja_id', '<=', 19)->get();
    $unit_kerja = UnitKerja::where('id', '<=', 19)->get();


    return view('thl', compact('users', "unit_kerja",));
});

Route::get('/add-user', UserController::class . '@addUser');
Route::get('/edit-user/{id}', UserController::class . '@editUser');
Route::post('/edit-user/{id}/update', UserController::class . '@updateUser');
Route::post('/add-user/store', [UserController::class, 'storeUser']);
Route::delete('/user/{id}/delete', UserController::class . '@deleteUser');

//DATA ADMIN
Route::get('/admin', UserController::class . '@admin');
Route::get('/add-admin', UserController::class . '@addAdmin');
Route::get('/edit-admin/{id}', UserController::class . '@editAdmin');
Route::post('/add-admin/store', [UserController::class, 'storeAdmin']);
Route::post('/edit-admin/{id}/update', UserController::class . '@updateAdmin');
Route::delete('/admin/{id}/delete', UserController::class . '@deleteAdmin');

//REKAP ABSEN
Route::get('/rekap-absen', RekapController::class . '@index');
Route::get('/rekap-absen/{id}', RekapController::class . '@showIndex');

//laporan
Route::post('/cetak-thl', LaporanController::class . '@cetakThl');
Route::post('/cetak-rekap', LaporanController::class . '@cetakRekap');
