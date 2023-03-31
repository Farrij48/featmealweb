<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return redirect()-> route('login');
});

Auth::routes();

Route::match(["GET","POST"],"/register",function(){
    return redirect("/login");
})->name("register");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('template','layouts.bootstrap');
Route::resource('users',UserController::class);
Route::resource('category',CategoryController::class);
?>