<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticationController::class, 'create'])->name('login'); 
    Route::post('login', [AuthenticationController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('/',[HomeController::class,'index'])->name('home');

    Route::get('employees', [EmployeeController::class,'index']);
    Route::get('tasks', [TaskController::class,'index']);
    Route::get('departments', [DepartmentController::class,'index']);
});