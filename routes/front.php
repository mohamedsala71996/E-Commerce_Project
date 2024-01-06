<?php

use App\Http\Controllers\front\ProductController;

Route::middleware([])->group(function () {


    Route::get('/products', [ProductController::class,'index'])->name('frontproducts.index');
    Route::get('/product/{product:slug}', [ProductController::class,'show'])->name('product.show');



});



