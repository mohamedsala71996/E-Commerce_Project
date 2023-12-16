<?php
use App\Http\Controllers\Dashboard\CategoryController;
Route::middleware(['auth','verified'])->group(function () {

    Route::resource('dashboard/categories', CategoryController::class);
});



