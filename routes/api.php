<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\MasukController;
use App\Http\Controllers\API\PulangController;
use App\Http\Controllers\API\Siang1Controller;
use App\Http\Controllers\API\Siang2Controller;
use App\Http\Controllers\API\AbsensiController;
use App\Http\Controllers\API\UnitKerjaController;
use App\Http\Controllers\API\MobileAbsensiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource("users", UserController::class);
Route::apiResource("absensi", AbsensiController::class);
Route::apiResource("masuk", MasukController::class);
Route::apiResource("pulang", PulangController::class);
Route::apiResource("siang1", Siang1Controller::class);
Route::apiResource("siang2", Siang2Controller::class);
Route::apiResource("unit-kerja", UnitKerjaController::class);

Route::post("/login", [LoginController::class, "login"]);
Route::post("/logout", [LoginController::class, "logout"]);

Route::post('/images', [ImageController::class, 'store']);

Route::post('/v1/doabsen', [MobileAbsensiController::class, 'doAbsen']);
Route::get('/v1/getabsen/{param1}', [MobileAbsensiController::class, 'getAbsen']);
