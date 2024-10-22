<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);
// Rutas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

 //Rutas protegidas
//Route::middleware('auth:sanctum')->group(function () {
    // Rutas para Productos
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Rutas para Categorías usando apiResource
    Route::apiResource('categories', CategoryController::class);

    // Rutas para Pedidos usando apiResource
    Route::apiResource('orders', OrderController::class);
//});

 //Ruta para obtener información del usuario autenticado
 //Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   //  return $request->user();
   // });
