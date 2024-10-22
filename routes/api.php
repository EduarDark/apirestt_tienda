<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

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

/*
|--------------------------------------------------------------------------|
| API Routes                                                               |
|--------------------------------------------------------------------------|
| Here is where you can register API routes for your application. These   |
| routes are loaded by the RouteServiceProvider and all of them will      |
| be assigned to the "api" middleware group. Make something great!        |
|--------------------------------------------------------------------------|
*/

// Ruta para obtener información del usuario autenticado
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});
