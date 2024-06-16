<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;


Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::get('/register', [PageController::class, 'register'])->name('register');
});
//back end
Route::post('/register/proses', [ProfileController::class, 'register'])->name('register.proses');
Route::post('/login/proses', [ProfileController::class, 'login'])->name('login.proses');
Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');

Route::middleware(['second'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/task', [PageController::class, 'task'])->name('task');
    Route::post('/task/proses', [TaskController::class, 'store'])->name('task.proses');
    Route::get('/task/update/{id?}', [TaskController::class, 'update_view'])->name('update.view');
    Route::post('/task/update/{id?}', [TaskController::class, 'update_task'])->name('update_task');
    Route::delete('/task/delete/{id?}', [TaskController::class, 'delete_task'])->name('delete_task');
    // enable status
    Route::post('/task/status/{id?}', [TaskController::class, 'enable_status'])->name('enable_status');

    // profile
    Route::get('/profile', [ProfileController::class, 'detail_profile'])->name('detail_profile');
    Route::post('/edit/profile', [ProfileController::class, 'edit_profile'])->name('edit_profile');

    //category tasks
    Route::get('/task/category/{id}', [PageController::class, 'view_task_category'])->name('view_task_category');
    Route::post('/task/category', [TaskController::class, 'task_category'])->name('task_category');

    //comments tasks
    Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('comments.store');


});

