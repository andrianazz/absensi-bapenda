<?php

use App\Models\Absensi;
use App\Models\Masuk;
use App\Models\Pulang;
use App\Models\Siang1;
use App\Models\Siang2;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    $users = User::all();
    $unit_kerja = UnitKerja::all();
    $absensi = Absensi::all();
    $masuk = Masuk::all();
    $siang = Siang1::all();
    $siang2 = Siang2::all();
    $pulang = Pulang::all();

    return view('welcome', compact('users', "unit_kerja", "absensi", "masuk", "siang", "siang2", "pulang"));
});
