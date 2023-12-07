<?php

use App\Http\Controllers\API\AbsensiController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\MasukController;
use App\Http\Controllers\API\PulangController;
use App\Http\Controllers\API\Siang1Controller;
use App\Http\Controllers\API\Siang2Controller;
use App\Http\Controllers\API\UnitKerjaController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource("users", UserController::class)>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");
Route::apiResource("absensi", AbsensiController::class)>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");
Route::apiResource("masuk", MasukController::class)>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");
Route::apiResource("pulang", PulangController::class)>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");
Route::apiResource("siang1", Siang1Controller::class)>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");
Route::apiResource("siang2", Siang2Controller::class)>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");
Route::apiResource("unit-kerja", UnitKerjaController::class)>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");

Route::post("/login", [LoginController::class, "login"])>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");
Route::post("/logout", [LoginController::class, "logout"])>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");

Route::post('/images', [ImageController::class, 'store'])>withoutMiddleware("throttle:api")
->middleware("throttle:300:1");
