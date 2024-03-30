<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [BrandController::class, 'index']);
Route::post('/addbrands', [BrandController::class, 'add']);
Route::delete('/delete/{id}', [BrandController::class, 'delete']);
// Route::get('/edit/{id}', [BrandController::class, 'edit']);
Route::post('/edit/{id}', [BrandController::class, 'update']);


Route::get('/customer', [CustomerController::class, 'index']);
Route::post('/addCustomer', [CustomerController::class, 'add']);
Route::delete('/deleteCustomer/{id}', [CustomerController::class, 'delete']);
// Route::get('/editCustomer/{id}', [CustomerController::class, 'edit']);
Route::post('/editCustomer/{id}', [CustomerController::class, 'update']);
