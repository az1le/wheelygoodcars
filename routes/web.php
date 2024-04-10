<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

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
})->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('cars', CarController::class)->except('index');
    Route::get('dashboard', [CarController::class, 'dashboard'])->name('cars.dashboard');
});

Route::get('cars', [CarController::class, 'index'])->name('cars.index');

require __DIR__.'/auth.php';
