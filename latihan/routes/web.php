<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('layouts/app');
});

Route::resource('images', ImageController::class);


