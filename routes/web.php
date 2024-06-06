<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FigureController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/figure', function () {
    return view('pages.plp');
})->name('plp');

Route::get('/figure/{i}', function () {
    return view('pages.pdp');
})->name('pdp');