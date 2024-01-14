<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\ProductController;

Route::middleware([])->group(function () {


    Route::get('/products', [ProductController::class,'index'])->name('frontproducts.index');
    Route::get('/product/{product:slug}', [ProductController::class,'show'])->name('product.show');
    Route::resource('carts', CartController::class);

    Route::get('/checkout/create', [CheckoutController::class,'create'])->name('checkout.create');
    Route::post('/checkout/store', [CheckoutController::class,'store'])->name('checkout.store');




});



