<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TbSpiderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\NavController;
use App\Http\Controllers\Backend\KeywordController;

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
Route::get('keyword',[KeywordController::class, 'index'])->name('keyword.index');
    Route::get('keyword/create', [KeywordController::class, 'create'])->name('keyword.create');
    Route::post('keyword', [KeywordController::class, 'store'])->name('keyword.store');
    Route::post('keyword/upload', [KeywordController::class, 'upload'])->name('store.keyword.upload');

    Route::group(['prefix' => 'keyword/{keyword}'], function () {
        Route::get('edit', [KeywordController::class, 'edit'])->name('keyword.edit');
        Route::delete('/', [KeywordController::class, 'destroy'])->name('keyword.destroy');
    });
});
