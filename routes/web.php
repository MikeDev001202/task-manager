<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

// login
Route::get('task-manager/', [LoginController::class, 'index'])->name('login');
Route::post('task-manager/login', [LoginController::class, 'login'])->name('loginUser');
Route::post('task-manager/logout', [LoginController::class, 'logout'])->name('logoutUser');


// register
Route::get('task-manager/register', [RegisterController::class, 'index']);
Route::post('task-manager/register/create', [RegisterController::class, 'store'])->name('register.create');

// home
Route::middleware(['auth'])->group(function () {
    Route::get('task-manager/home', [HomeController::class, 'index'])->name('homepage');
    
    // Tasks routes
    Route::get('task-manager/schedule', [TaskController::class, 'schedule'])->name('scheduleTask');
    Route::post('task-manager/schedule/create', [TaskController::class, 'storeTask'])->name('storeTask');
    Route::get('task-manager/view-all', [TaskController::class, 'viewAllTasks'])->name('viewTasks');
    Route::get('task-manager/view-task/{taskId}', [TaskController::class, 'viewTask'])->name('viewTask');
    Route::get('task-manager/edit-task/{taskId}', [TaskController::class, 'editTask'])->name('editTask');
    Route::put('task-manager/edit-task/{taskId}/update', [TaskController::class, 'updateTask'])->name('updateTask');
    Route::delete('task-manager/delete-task/{taskId}', [TaskController::class, 'deleteTask'])->name('deleteTask');
});