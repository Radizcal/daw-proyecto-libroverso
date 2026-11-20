<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\CosmeticItemController;
use App\Http\Controllers\Api\InventoryItemController;
use App\Http\Controllers\Api\ReadingSessionController;
use App\Http\Controllers\Api\UserBookController;
use Illuminate\Support\Facades\Route;

// Rutas de la API.
Route::prefix('v1')->group(function () {

    // Rutas de autenticación.
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    // Rutas para consultar los libros y gestionar la biblioteca personal.
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/books', [BookController::class, 'index']);
        Route::get('/books/{id}', [BookController::class, 'show']);

        // Rutas para gestionar la biblioteca personal.
        Route::get('/my-books', [UserBookController::class, 'index']);
        Route::get('/my-books/{id}', [UserBookController::class, 'show']);
        Route::post('/my-books', [UserBookController::class, 'store']);
        Route::put('/my-books/{id}', [UserBookController::class, 'update']);
        Route::patch('/my-books/{id}', [UserBookController::class, 'update']);
        Route::delete('/my-books/{id}', [UserBookController::class, 'destroy']);

        // Rutas para registrar sesiones de lectura.
        Route::get('/reading-sessions', [ReadingSessionController::class, 'index']);
        Route::post('/reading-sessions', [ReadingSessionController::class, 'store']);

        // Ruta para consultar el personaje del usuario.
        Route::get('/character', [CharacterController::class, 'show']);

        // Ruta para consultar el catálogo de objetos cosméticos.
        Route::get('/cosmetic-items', [CosmeticItemController::class, 'index']);

        // Ruta para consultar el inventario del usuario.
        Route::get('/inventory', [InventoryItemController::class, 'index']);

        // Ruta para comprar objetos cosméticos.
        Route::post('/inventory', [InventoryItemController::class, 'store']);

        // Ruta para equipar o desequipar objetos.
        Route::patch('/inventory/{id}', [InventoryItemController::class, 'update']);
    });

    // Rutas para administrar los libros (solo admin).
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {

        Route::post('/books', [BookController::class, 'store']);
        Route::put('/books/{id}', [BookController::class, 'update']);
        Route::patch('/books/{id}', [BookController::class, 'update']);
        Route::delete('/books/{id}', [BookController::class, 'destroy']);
    });
});
