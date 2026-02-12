<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/learn', function () {
    return view('learn');
});

Route::get('/trade', function () {
    return view('trade');
});

Route::get('/invest', function () {
    return view('invest');
});

