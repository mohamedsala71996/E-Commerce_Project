<?php
use App\Http\Controllers\Dashboard\CategoryController;
Route::middleware(['auth','verified'])->group(function () {

    Route::resource('dashboard/categories', CategoryController::class);

    Route::get('categories/trashes', [CategoryController::class, 'viewTrashes'])->name('categories.trashes');
    Route::delete('categories/force-delete/{CategoryId}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::get('categories/restore-trashes/{CategoryId}', [CategoryController::class, 'restoreTrashes'])->name('categories.restoreTrashes');

});



