<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PhotoController;

Route::get('/', function () {
    return view('welcome');
});

Route::post("addLogo",[UploadController::class, 'imgEdit']);




Route::post("photo",[PhotoController::class, 'photoEdit']);