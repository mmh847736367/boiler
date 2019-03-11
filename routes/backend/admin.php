<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TbSpiderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\NavController;
/*
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('spider/tb/show',[TbSpiderController::class, 'showPageIndex'])->name('spider.tbshow');
Route::post('spider/tb/show',[TbSpiderController::class, 'getGoodInfo'])->name('spider.tbshow.info');
Route::get('spider/tb/search', [TbSpiderController::class, 'searchPageIndex'])->name('spider.tbsearch');
Route::post('spider/tb/search', [TbSpiderController::class, 'getSearchItem'])->name('spider.tbsearch.item');



/*
 * Category Management
 */
Route::group(['prefix' => 'content'], function () {
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');

    Route::group(['prefix' => 'category/{category}'], function () {
        Route::get('edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::patch('/', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});

/*
 * Nav Management
 */
Route::group(['prefix' => 'content'], function () {
Route::get('nav',[NavController::class, 'index'])->name('nav.index');
    Route::get('nav/create', [NavController::class, 'create'])->name('nav.create');
    Route::post('nav', [NavController::class, 'store'])->name('nav.store');

    Route::group(['prefix' => 'nav/{nav}'], function () {
        Route::get('edit', [NavController::class, 'edit'])->name('nav.edit');
        Route::patch('/', [NavController::class, 'update'])->name('nav.update');
        Route::delete('/', [NavController::class, 'destroy'])->name('nav.destroy');
    });
});