<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/account', [App\Http\Controllers\UserController::class, 'index'])->name('account');
        Route::post('/account', [App\Http\Controllers\UserController::class, 'store'])->name('account.store');
        Route::put('/account/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('account.update');
        Route::delete('/account/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('account.destroy');
    });

    Route::get('/post', [App\Http\Controllers\PostController::class, 'index'])->name('post');
    Route::post('/post', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::put('/post/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
});
