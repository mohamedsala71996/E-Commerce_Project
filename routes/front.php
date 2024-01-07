<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ProductController;

Route::middleware([])->group(function () {


    Route::get('/products', [ProductController::class,'index'])->name('frontproducts.index');
    Route::get('/product/{product:slug}', [ProductController::class,'show'])->name('product.show');
    Route::resource('carts', CartController::class);




});



