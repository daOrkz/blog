<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Main')->group(function (){
    Route::get('/', 'IndexController');
});

Route::middleware(['auth', 'verified'])->namespace('Personal')->prefix('personal')->name('personal.')->group(function () {
    Route::namespace('Main')->group(function () {
        Route::get('/', 'IndexController')->name('index');
    });
});

Route::middleware(['auth', 'admin', 'verified'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Main')->group(function (){
        Route::get('/', 'IndexController')->name('index');
    });

    Route::namespace('Category')->prefix('categories')->name('categories.')->group(function (){
        Route::get('/', 'IndexController')->name('index');
        Route::get('/create', 'CreateController')->name('create');
        Route::get('/{id}', 'ShowController')->name('show');
        Route::get('/{id}/edit', 'EditController')->name('edit');

        Route::patch('/{id}', 'UpdateController')->name('update');
        Route::post('/create', 'StoreController')->name('store');

        Route::delete('/{id}', 'DestroyController')->name('destroy');
    });

    Route::namespace('Tag')->prefix('tags')->name('tags.')->group(function (){
        Route::get('/', 'IndexController')->name('index');
        Route::get('/create', 'CreateController')->name('create');
        Route::get('/{id}', 'ShowController')->name('show');
        Route::get('/{id}/edit', 'EditController')->name('edit');

        Route::patch('/{id}', 'UpdateController')->name('update');
        Route::post('/create', 'StoreController')->name('store');

        Route::delete('/{id}', 'DestroyController')->name('destroy');
    });

    Route::namespace('Post')->prefix('posts')->name('posts.')->group(function (){
        Route::get('/', 'IndexController')->name('index');
        Route::get('/create', 'CreateController')->name('create');
        Route::get('/{id}', 'ShowController')->name('show');
        Route::get('/{id}/edit', 'EditController')->name('edit');

        Route::patch('/{id}', 'UpdateController')->name('update');
        Route::post('/create', 'StoreController')->name('store');

        Route::delete('/{id}', 'DestroyController')->name('destroy');
    });

    Route::namespace('User')->prefix('users')->name('users.')->group(function (){
        Route::get('/', 'IndexController')->name('index');
        Route::get('/create', 'CreateController')->name('create');
        Route::get('/{id}', 'ShowController')->name('show');
        Route::get('/{id}/edit', 'EditController')->name('edit');

        Route::patch('/{id}', 'UpdateController')->name('update');
        Route::post('/create', 'StoreController')->name('store');

        Route::delete('/{id}', 'DestroyController')->name('destroy');
    });
});

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
