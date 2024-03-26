<?php

use App\Http\Controllers\Dashboard\AdminRolesController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserRolesController;
use App\Http\Controllers\NotificationController;

Route::middleware(['auth:admin,web','verified'])->group(function () {

    // categouries
    Route::resource('dashboard/categories', CategoryController::class);
    Route::get('categories/trashes', [CategoryController::class, 'viewTrashes'])->name('categories.trashes');
    Route::delete('categories/force-delete/{CategoryId}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::get('categories/restore-trashes/{CategoryId}', [CategoryController::class, 'restoreTrashes'])->name('categories.restoreTrashes');

    // products
    Route::resource('dashboard/products', ProductController::class);

    // profile
    Route::get('dashboard/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('dashboard/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('dashboard/mark-as-read/{id}',  [NotificationController::class, 'markAsRead'])->name('markAsRead');

    //roles
    Route::resource('dashboard/roles', RoleController::class);


    Route::resource('dashboard/admins', AdminRolesController::class);
    Route::resource('dashboard/users', UserRolesController::class);

});



