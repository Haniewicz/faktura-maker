<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DashboardController;

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

//Routes only for not logged users
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [MainController::class, 'index'])->name('login');
    Route::post('/login', [MainController::class, 'login']);
    Route::post('/register', [MainController::class, 'register']);
});

//Routes only for logged users
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/list_vats', [DashboardController::class, 'list_vats_view']);

    Route::get('/add_vat', [DashboardController::class, 'add_vat_view']);
    Route::post('/add_vat', [DashboardController::class, 'add_vat'])->name('add.vat');

    Route::get('/edit_vat/{id}', [DashboardController::class, 'edit_vat_view']);
    Route::post('/edit_vat', [DashboardController::class, 'edit_vat'])->name('edit.vat');

    Route::get('/delete_vat/{id}', [DashboardController::class, 'delete_vat']);

    Route::get('/logout', [DashboardController::class, 'logout']);
});
