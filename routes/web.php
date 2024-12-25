<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post("/login",[AuthController::class,"login"])->name("loginEndpoint");
Route::post("/register",[AuthController::class,"register"])->name("registerEndpoint");