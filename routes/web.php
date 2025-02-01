<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ViewController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/login', [AuthApiController::class, 'login'])->name('login');
Route::post('/admin/logout', [AuthApiController::class, 'adminLogout'])->name('adminLogout');
Route::post('/admin/login', [AuthApiController::class, 'adminLogin'])->name('adminLogin');
Route::post('/register', [AuthApiController::class, 'register']);


Route::get('/user/{id}', [UserController::class, 'getUserById']);
Route::get('/team/{teamId}/users', [UserController::class, 'getUsersByTeamId']);

Route::post('/teams', [TeamController::class,'createTeam']);
Route::get('/teams', [TeamController::class,'teamList'])->name('teamList')->middleware('isAdmin');
Route::get('/teams/name/{stat}',[TeamController::class,'showTeamSortbyName'])->name('sortByName')->middleware('isAdmin');;
Route::get('/teams/time/{stat}',[TeamController::class,'showTeamSortbyTime'])->name('sortByTime')->middleware('isAdmin');;
Route::get('/teams/name/{name}',[TeamController::class,'searchByName'])->name('searchByName')->middleware('isAdmin');;
Route::get('/teams/{teamId}/edit',[TeamController::class, 'editTeam'])->name('editTeam')->middleware('isAdmin');
Route::put('/teams/{teamId}', [TeamController::class, 'updateTeam'])->name('updateTeam')->middleware('isAdmin');
Route::delete('/teams/{teamId}', [TeamController::class,'deleteTeam'])->name('deleteTeam')->middleware('isAdmin');

// view controller

Route::get('/', [ViewController::class, 'viewHome'])->name('viewHome');
Route::get('/login', [ViewController::class, 'viewLogin'])->name('loginView');
Route::get('/dashboard', [ViewController::class, 'viewUserDashboard'])->name('dashboardView');
Route::get('/admin', [ViewController::class,"viewAdminLogin"])->name('viewAdminLogin');
Route::get('/admin/dashboard', [TeamController::class,"teamList"])->name('adminDashboardView')->middleware('isAdmin');