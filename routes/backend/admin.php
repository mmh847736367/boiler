<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TbSpiderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\KeywordController;
use App\Http\Controllers\Backend\Nccne\BlockController;
/*
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('content', [DashboardController::class, 'jiangshanshi'])->name('jiangshanshi');
Route::get('spider/tb/show',[TbSpiderController::class, 'showPageIndex'])->name('spider.tbshow');
Route::post('spider/tb/show',[TbSpiderController::class, 'getGoodInfo'])->name('spider.tbshow.info');
Route::get('spider/tb/search', [TbSpiderController::class, 'searchPageIndex'])->name('spider.tbsearch');
Route::post('spider/tb/search', [TbSpiderController::class, 'getSearchItem'])->name('spider.tbsearch.item');



/*
 * jiangshanshi Category Management
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
 * jiangshanshi Keyword Management
 */
Route::group(['prefix' => 'content'], function () {
    Route::get('keyword',[KeywordController::class, 'index'])->name('keyword.index');
    Route::get('keyword/create', [KeywordController::class, 'create'])->name('keyword.create');
    Route::post('keyword', [KeywordController::class, 'store'])->name('keyword.store');
    Route::post('keyword/filter', [KeywordController::class, 'filterStore'])->name('keyword.filter.store');
    Route::post('keyword/upload', [KeywordController::class, 'upload'])->name('store.keyword.upload');
    Route::post('keyword/filter/upload', [KeywordController::class, 'filterUpload'])->name('store.keyword.filter.upload');
//    Route::get('keyword/search', [KeywordController::class, 'search'])->name('keyword.search');

    Route::group(['prefix' => 'keyword/{keyword}'], function () {
        Route::get('edit', [KeywordController::class, 'edit'])->name('keyword.edit');
        Route::delete('/', [KeywordController::class, 'destroy'])->name('keyword.destroy');
    });
});

Route::get('nccne', [\App\Http\Controllers\Backend\Nccne\DashboardController::class, 'index'])->name('nccne');


Route::group(['prefix' => 'nccne'], function() {
    Route::get('block', [BlockController::class, 'index'])->name('nccne.block.index');

    Route::group(['prefix' => 'block/{block}'], function() {
        Route::get('edit', [BlockController::class, 'edit'])->name('nccne.block.edit');
        Route::patch('/', [BlockController::class, 'update'])->name('nccne.block.update');
        Route::delete('/', [BlockController::class, 'destroy'])->name('nccne.block.destroy');
    });


});












