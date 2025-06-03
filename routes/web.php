<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\PostinganController;
use App\Http\Controllers\Front\PostinganController as FrontPostinganController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [HomeController::class, 'index']);
Route::POST('/postingan/search', [HomeController::class, 'index'])->name('search');

Route::get('/p/{slug}', [FrontPostinganController::class, 'show'])->name('poatingan.show');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/postingan', PostinganController::class);

    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy'])->middleware([\App\Http\Middleware\UserAccess::class . ':1']);

    Route::resource('/users', UserController::class);

    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
