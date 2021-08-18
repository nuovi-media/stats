<?php

use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', fn() => view('admin/welcome'));
    // Configuration routes
    Route::get('config/database', [ConfigController::class, 'database'])->name('config.database');
    Route::get('config/letterboxd', [ConfigController::class, 'letterboxd'])->name('config.letterboxd');
    Route::put('config', [ConfigController::class, 'store'])->name('config.store');
    Route::patch('config', [ConfigController::class, 'store']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

