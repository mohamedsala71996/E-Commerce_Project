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
// })->middleware(['auth', 'verified','checkType:admin,super-admin'])->name('dashboard');

Route::middleware('auth:admin,web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
    //-------------------------------custom logout--------------------------------
Route::post('Admin/logout', [CustomLogoutController::class, 'admin_logout'])->name('admin_logout');

    //-------------------------------Currency API--------------------------------

Route::post('CurrencyConverter', [CurrencyConverterController::class, 'store'])->name(  'currencyConverter.store' );

// require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/front.php';
