<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Main')->group(function (){
    Route::get('/', 'IndexController');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
