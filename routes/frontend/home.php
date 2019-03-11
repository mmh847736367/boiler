<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ImageController;
use App\Http\Middleware\RedirectForSeo;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::middleware(RedirectForSeo::class)->group(function() {
    Route::get('lm{category}/{page?}', [PageController::class, 'lanmu'])->where('page', '[0-9]+\.html')->name('categoty');
    Route::get('s/{slug}/{page?}', [PageController::class, 'search'])->where('page', '[0-9]+\.html')->name('search');
});
Route::post('query', [PageController::class, 'formSearch'])->name('form.search');
Route::get('g/{id}.html', [PageController::class, 'show'])->name('good');

Route::get('img/upload/{slug}', [ImageController::class, 'taobao'])->name('image');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', [AccountController::class, 'index'])->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});
