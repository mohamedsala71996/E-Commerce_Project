<?php

use App\Http\Controllers\Auth\CustomLogoutController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\HomeController;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

], function(){

    Route::get('/', [HomeController::class,'index'])->name('home');

    Route::get('/products', [ProductController::class,'index'])->name('frontproducts.index');
    Route::get('/product/{product:slug}', [ProductController::class,'show'])->name('product.show');
    Route::resource('carts', CartController::class);

    Route::get('/checkout/create', [CheckoutController::class,'create'])->name('checkout.create');
    Route::post('/checkout/store', [CheckoutController::class,'store'])->name('checkout.store');
    //-------------------------------custom logout--------------------------------
    Route::post('user/logout', [CustomLogoutController::class, 'user_logout'])->name('user_logout');


    Route::get('/twoFactor', function (){
        return view('front.auth.two-factor-authentication');
    });

  

});



