<?php

use App\Http\Controllers\NotaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {
    // Additional endpoints (must be defined before the resource to avoid conflicts)
    Route::get('notas/buscar/{patron}', [NotaController::class, 'buscar']);
    Route::get('notas/resumen', [NotaController::class, 'resumen']);

    // Resource routes for notas
    Route::apiResource('notas', NotaController::class);
});
