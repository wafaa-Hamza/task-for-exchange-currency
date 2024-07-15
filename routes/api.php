<?php

use App\Http\Controllers\AmountController;
use App\Http\Controllers\ConfigController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
/////////Config Routes//////////////////////////

// Route::resource('config',ConfigController::class);

Route::get('config', [ConfigController::class, 'index']);
Route::post('config-data', [ConfigController::class, 'store']);
Route::delete('config-data/{currency}', [ConfigController::class, 'update']);
Route::delete('config/{currency}', [ConfigController::class, 'destroy']);


/////////////// Amonut Routes////////////////////////////

// Route::resource('amounts',AmountController::class);

Route::get('amounts', [AmountController::class, 'index']);
Route::post('amount', [AmountController::class, 'store']);
Route::put('amount-data/{id}', [AmountController::class, 'update']);
Route::delete('amounts/{id}', [AmountController::class, 'destroy']);
