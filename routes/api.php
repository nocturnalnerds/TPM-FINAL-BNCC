<?php
// filepath: /Users/mac/Desktop/TPM_FINAL_BNCC_WORKSPACE/tpmFinal/routes/api.php
use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);