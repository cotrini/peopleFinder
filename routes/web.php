<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});

Route::get('/finder', [PageController::class, 'fetchExternalPage']);
Route::get('/show', [PageController::class, 'show']);