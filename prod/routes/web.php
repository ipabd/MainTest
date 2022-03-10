<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('product');
Route::get('/send/{prod}', [App\Http\Controllers\SendMailController::class, 'send'])->name('send');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register.create');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login.create');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
});
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout')->middleware('auth');
////admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('/prod', 'App\Http\Controllers\Admin\ProductController');
});