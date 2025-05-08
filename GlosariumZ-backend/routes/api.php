<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IstilahController;

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

Route::prefix('istilah')->group(function () {
    Route::get('/{id}', [IstilahController::class, 'show']);
    Route::post('/', [IstilahController::class, 'store']);
    Route::delete('/{id}', [IstilahController::class, 'destroy']);
    Route::put('/{id}', [IstilahController::class, 'update']);
});
