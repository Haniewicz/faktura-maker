<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EditProfileController;


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
    Route::get('/list_vats', [VatController::class, 'show_list']);

    Route::get('/add_vat', [VatController::class, 'show_add']);
    Route::post('/add_vat', [VatController::class, 'store'])->name('add.vat');

    Route::get('/edit_vat/{id}', [VatController::class, 'show_edit']);
    Route::post('/edit_vat', [VatController::class, 'update'])->name('edit.vat');

    Route::post('/delete_product', [ProductController::class, 'delete'])->name('delete.product');

    Route::get('/delete_vat/{id}', [VatController::class, 'delete']);

    Route::get('/profile', [EditProfileController::class, 'show']);
    Route::post('/profile', [EditProfileController::class, 'update'])->name('edit.profile');

    Route::get('/logout', [DashboardController::class, 'logout']);
});
