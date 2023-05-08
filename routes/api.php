<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PasienController;
use App\Http\Controllers\Api\ResepController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('category',[CategoryController::class,'getAll']);
Route::post('login',[PasienController::class,'login']);
Route::post('resep-by-category',[ResepController::class,'getByCategory']);
Route::post('resep-by-id',[ResepController::class,'getById']);