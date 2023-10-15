<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PotsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin/pots', [PotsController::class, 'index'])->middleware('auth')->name('admin.pots.index');

Route::get('/admin/pots/create', [PotsController::class, 'create'])->middleware('auth')->name('admin.pots.create');

Route::post('/admin/pots/store', [PotsController::class, 'store'])->middleware('auth')->name('admin.pots.store');
