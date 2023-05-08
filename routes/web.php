<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\CustomAuthController;



//  LOGIN REGISTER //

Route::get('/registration', function () {
    return view('auth.registration');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('home', [CustomAuthController::class, 'home']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::group(['middleware' => ['auth']],function(){
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::view('template','layouts.bootstrap');

//-------------- ROUTE USERS CONTROLLERS ---------------------//
Route::resource('users',UserController::class);

Route::get('category/trash',[CategoryController::class,'trash'])->name('category.trash');
Route::get('category/{id}/restore',[CategoryController::class,'restore'])->name('category.restore');
Route::delete('category/{category}/delete-permanent',[CategoryController::class,'deletePermanent'])->name('category.delete-permanent');
Route::resource('category',CategoryController::class);

//------------- ROUTE PASIEN CONTROLLERS ---------------------//
Route::post('pasien/{pasien}/resetpassword',[PasienController::class,'resetpassword'])->name('pasien.resetpassword');
Route::resource('pasien',PasienController::class);

Route::get('resep/trash',[ResepController::class,'trash'])->name('resep.trash');
Route::get('resep/{id}/restore',[ResepController::class,'restore'])->name('resep.restore');
Route::delete('resep/{resep}/delete-permanent',[ResepController::class,'deletePermanent'])->name('resep.delete-permanent');
Route::get('resep/{resep}/download',[ResepController::class,'download'])->name('resep.download');
Route::resource('resep',ResepController::class);

//--------- ROUTE MODULE PAGE ---------------------------------------//
Route::get('module',[ModuleController::class,'index'])->name('module');
Route::get('module/{id}/detail',[ModuleController::class,'detail'])->name('module.detail');
Route::get('module/{module}/create',[ModuleController::class,'create'])->name('module.create');
Route::post('module/store',[ModuleController::class,'store'])->name('module.store');
Route::get('module/{module}/edit',[ModuleController::class,'edit'])->name('module.edit');
Route::put('module/{module}/update',[ModuleController::class,'update'])->name('module.update');
Route::get('module/{module}/download',[ModuleController::class,'download'])->name('module.download');
Route::get('module/{module}/show',[ModuleController::class,'show'])->name('module.show');
Route::delete('module/{module}/destroy',[ModuleController::class,'delstroy'])->name('module.destroy');
});
?>