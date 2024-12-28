<?php
// filepath: /Users/mac/Desktop/TPM_FINAL_BNCC_WORKSPACE/tpmFinal/routes/api.php
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/admin/login', [AuthApiController::class, 'adminLogin']);
Route::post('/register', [AuthApiController::class, 'register']);

Route::get('/user/{id}', [UserController::class, 'getUserById']);
Route::get('/team/{teamId}/users', [UserController::class, 'getUsersByTeamId']);