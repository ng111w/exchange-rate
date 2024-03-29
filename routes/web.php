<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/search", [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get("/search-form", [App\Http\Controllers\SearchController::class, 'search'])->name('search.form');