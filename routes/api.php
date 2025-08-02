<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SwaggerController;
use \App\Http\Controllers\ProxyController;
use Illuminate\Support\Facades\Log;

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
// ->middleware('auth:sanctum');


// Route::get('/users', [\App\Http\Controllers\SwaggerController::class, 'show'])
//     ->name('swagger.yaml')
//     ->middleware('auth:sanctum');

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
Route::post('/password/reset', [ProxyController::class, 'forgotPassword']);
Route::post('/verify_code', [ProxyController::class, 'verify_code']);

Route::prefix('apikeys/')->group(function () {
    Route::any('{path?}', [ProxyController::class, 'apikeys'])->where('path', '.*');
});

// Route::prefix('transactions/')->group(function () {
//     Route::any('{path?}', [ProxyController::class, 'transactions'])->where('path', '.*');
// });

// Route::any('/operations', [ProxyController::class, 'operations']); // Route racine
Route::prefix('transactions')->group(function () {
    Route::any('/{path?}', [ProxyController::class, 'transactions'])->where('path', '.*');
});

// Route::any('{path?}', [ProxyController::class, 'transactions'])->where('path', '.*');
Route::any('{path?}', [ProxyController::class, 'userProtected'])->where('path', '.*');


// Route::any('{path?}', function ($path = '') {
//     Log::info('Route transactions appelée avec path: ' . $path);
//     return app(ProxyController::class)->transactions(request(), $path);
// })->where('path', '.*');




// Routes proxy vers les microservices (exemples)
Route::prefix('/')->middleware(['auth:sanctum'])->group(function () {


    // Proxy vers Wallet Service
    Route::prefix('wallets')->group(function () {
        Route::any('{path?}', [ProxyController::class, 'wallet'])->where('path', '.*');
    });

    // Proxy vers Notification Service
    Route::prefix('notifications')->group(function () {
        Route::any('{path?}', [ProxyController::class, 'notification'])->where('path', '.*');
    });
});

Route::get('/connectivity', [ProxyController::class, 'testConnectivity']);
