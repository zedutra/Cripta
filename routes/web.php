<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

// Auth
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Painel Admininstrativo
Route::name('painel.')->prefix('painel')->middleware(['auth', 'can:admin'])->group(function () {
    // Painel
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@index')->name('home');

    // Admin
    Route::resource('admin', App\Http\Controllers\Admin\AdminController::class);
    Route::put('admin/{admin}/restore', [App\Http\Controllers\Admin\UserController::class, 'restore'])->name('admin.restore');

    // Usuarios
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    Route::put('user/{user}/restore', [App\Http\Controllers\Admin\UserController::class, 'restore'])->name('user.restore');

});
