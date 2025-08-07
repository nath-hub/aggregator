<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SwaggerController;
use \App\Http\Controllers\ProxyController;

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

Route::get('/example', [\App\Http\Controllers\SwaggerController::class, 'index'])
    ->name('example');

Route::prefix('docs')->group(function () {
    // Interface Swagger UI
    Route::get('/', [SwaggerController::class, 'index'])->name('swagger.index');

    // JSON Swagger unifié
    Route::get('/json', [SwaggerController::class, 'json'])->name('swagger.json');

    // Refresh du cache
    Route::post('/refresh', [SwaggerController::class, 'refresh'])->name('swagger.refresh');

    // Statut des microservices
    Route::get('/health', [SwaggerController::class, 'health'])->name('swagger.health');
});

Route::post('/register', [ProxyController::class, 'register']);
Route::post('/login', [ProxyController::class, 'login']);
Route::post('/forgot-password', [ProxyController::class, 'forgotPassword']);
Route::post('/verify-code', [ProxyController::class, 'verify_code']);

Route::any('{path?}', [ProxyController::class, 'smartProxy'])
    ->where('path', '.*')
    ->name('smart.proxy');


Route::get('/connectivity', [ProxyController::class, 'testConnectivity']);
