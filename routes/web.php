<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clicked', function () {
    return '<h1>Hello World</h1>';
});

Route::get('/test', function () {
    return view('test');
});