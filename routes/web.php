<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Main')->group(function (){
    Route::get('/', 'IndexController');
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Main')->group(function (){
        Route::get('/', 'IndexController')->name('index');
    });

    Route::namespace('Category')->prefix('categories')->name('categories.')->group(function (){
        Route::get('/', 'IndexController')->name('index');
        Route::get('/create', 'CreateController')->name('create');
    });
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
