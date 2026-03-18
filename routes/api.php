<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
https://www.youtube.com/
Route::post('/vendas', [InventoryController::class, 'registerSale']);
Route::post('/entradas', [InventoryController::class, 'registerPurchase']);
// Route::get('/produtos', [InventoryController::class, 'index'] );
// Route::get('/produtos/{id}', [InventoryController::class, 'show'] );
// Route::put('/produtos/{id}', [InventoryController::class, 'update'] );
// Route::delete('/produtos/{id}', [InventoryController::class, 'destroy']);

Route::apiResource('/produtos', InventoryController::class); //Faz a mesma coisa que todas as rotas comentadas acima
