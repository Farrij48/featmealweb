<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PasienController;
use App\Models\Category;

Route::get('/', function () {
    return redirect()-> route('login');
});

Auth::routes();

Route::match(["GET","POST"],"/register",function(){
    return redirect("/login");
})->name("register");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('template','layouts.bootstrap');

//-------------- ROUTE USERS CONTROLLERS ---------------------//
Route::resource('users',UserController::class);

Route::get('category/trash',[CategoryController::class,'trash'])->name('category.trash');
Route::get('category/{id}/restore',[CategoryController::class,'restore'])->name('category.restore');
Route::delete('category/{category}/delete-permanent',[CategoryController::class,'deletePermanent'])->name('category.delete-permanent');
Route::resource('category',CategoryController::class);

//------------- ROUTE PASIEN CONTROLLERS ---------------------//
Route::resource('pasien',PasienController::class);
?>