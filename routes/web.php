<?php

use App\Http\Controllers\AmountController;
use App\Http\Controllers\ConfigController;
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


Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';


// Route::middleware(['auth'])->group(function () {
//     Route::get('dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

        /////////Config Routes//////////////////////////
    // Route::resource('currencies',ConfigController::class);

    Route::get('currencies', [ConfigController::class, 'index'])->name('currencies.index');
    Route::post('currencies', [ConfigController::class, 'store'])->name('currencies.store');
    Route::put('currencies/{currency}', [ConfigController::class, 'update'])->name('currencies.update');
    Route::delete('currencies/{currency}', [ConfigController::class, 'destroy'])->name('currencies.destroy');

            ///////////// Amonut Routes////////////////////////////

// Route::resource('amounts',AmountController::class);

    Route::get('amounts', [AmountController::class, 'index'])->name('amounts.index');
    Route::post('amounts', [AmountController::class, 'store'])->name('amounts.store');
    Route::put('amounts/{id}', [AmountController::class, 'update'])->name('amounts.update');
    Route::delete('amounts/{id}', [AmountController::class, 'destroy'])->name('amounts.destroy');
