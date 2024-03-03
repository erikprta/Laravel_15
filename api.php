<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasantriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\JenisController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('mahasantri', MahasantriController::class);
Route::apiResource('jurusan', JurusanController::class);
Route::apiResource('produk', ProdukController::class);
Route::apiResource('jenis', JenisController::class);