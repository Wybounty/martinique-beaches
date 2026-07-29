<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeachController;

Route::resource('beaches', BeachController::class);
Route::get('/', [BeachController::class, 'index']);
