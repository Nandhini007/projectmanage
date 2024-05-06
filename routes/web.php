<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Manage user
    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::match(['get', 'post'],'add_user', [UserController::class, 'add_user']);
    Route::get('/delete/{id}', [UserController::class, 'delete']);
    Route::match(['get', 'post'],'edit_user/{id}', [UserController::class, 'edit']);
    Route::match(['get', 'post'],'logout', [UserController::class,'logout'])->name('logout');

    // Manage project
    Route::get('/view_project', [ProjectController::class, 'index']);
    Route::match(['get', 'post'],'add_project', [ProjectController::class, 'add_project']);
    Route::get('/delete_project/{id}', [ProjectController::class, 'delete']);
    Route::match(['get', 'post'],'edit_project/{id}', [ProjectController::class, 'edit']);

    // Manage Task
    Route::get('view_task', [TaskController::class, 'view_task']);
    Route::match(['get', 'post'],'add_task', [TaskController::class, 'add_task']);
    Route::get('/delete_task/{id}', [TaskController::class, 'delete']);
    Route::match(['get', 'post'],'edit_task/{id}', [TaskController::class, 'edit']);
    Route::match(['get', 'post'],'update_task_status', [TaskController::class, 'update_task_status']);
});