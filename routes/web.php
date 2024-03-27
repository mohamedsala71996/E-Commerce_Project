<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\CustomLogoutController;
use App\Http\Controllers\front\CurrencyConverterController;
use App\Http\Controllers\LocalizationController;
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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth:admin,web', 'verified'])->name('dashboard');

    //-------------------------------custom logout--------------------------------
Route::post('Admin/logout', [CustomLogoutController::class, 'admin_logout'])->name('admin_logout');

    //-------------------------------Currency API--------------------------------

Route::post('CurrencyConverter', [CurrencyConverterController::class, 'store'])->name(  'currencyConverter.store' );

// require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/front.php';
