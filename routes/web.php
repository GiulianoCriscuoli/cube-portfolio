<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PanelController;
use App\Http\Controllers\Admin\PortfolioGroupController;
use App\Http\Controllers\Admin\PortfolioController;

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

// Route::get('/painel', [App\Http\Controllers\PanelController::class]);

Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index']);

Route::prefix('painel')->group(function() {

    Route::get('/', [App\Http\Controllers\Admin\PanelController::class, 'index'])->name('panel.index');
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'registerAction']);
    
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'loginAction']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
    Route::resource('/grupo-portfolio', Admin\PortfolioGroupController::class)->except(['show', 'store', 'edit', 'delete']);
    Route::resource('/portfolio', Admin\PortfolioController::class)->except(['show', 'store', 'edit', 'delete']);
});
