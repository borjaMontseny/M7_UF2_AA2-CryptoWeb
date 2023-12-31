<?php

use App\Http\Controllers\CryptoCurrencyController;
use App\Http\Controllers\CryptoCurrencyHistoricController;
use App\Http\Controllers\ExchangeController;
use App\Models\CryptoCurrency;
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
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/criptos', [CryptoCurrencyController::class, 'show'])->name('criptos');
    Route::get('/exchanges', [ExchangeController::class, 'show'])->name('exchanges');
    Route::get('/history/{cryptocurrency}', [CryptoCurrencyHistoricController::class, 'show'])->name('history');
});
