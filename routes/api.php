<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassModuleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route SignIn 

Route::post('signIn', [AuthController::class, 'signIn']);

// Route SignUp 

Route::post('signUp', [AuthController::class, 'signUp']);

// Route forgetpassword 

Route::post('forgetpassword', [AuthController::class, 'forgetpassword']);

// Route resetpassword

Route::post('resetpassword', [AuthController::class, 'resetpassword']);

// Group Middleware Route

Route::middleware('auth:sanctum')->group(function () {

  // user Route
  Route::Resource('users', UserController::class);

  // student Route
  Route::Resource('students', StudentController::class);

  // Class Route
  Route::resource('class', ClassModuleController::class);

  // user RouteDashboard
  Route::resource('dashboard', DashboardController::class);
  Route::post('logout', [AuthController::class, 'logout']);
});
