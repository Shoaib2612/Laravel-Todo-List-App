<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManager;
Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get("login",[AuthManager::class,"login"])->name("login");
Route::post("login",[AuthManager::class,"loginpost"])->name("login.post");

Route::get("register",[AuthManager::class,"register"])->name("register");
Route::post("register",[AuthManager::class,"registerpost"])->name("register.post");

Route::get("logout",[AuthManager::class,"logout"])->name("logout");

Route::middleware("auth")->group(function (){
    Route::get('/',[TaskManager::class,"listTask"])->name("home");
    Route::get("task/add",[TaskManager::class,"addTask"])->name("task.add");
    Route::post("task/add",[TaskManager::class,"addTaskPost"])->name("task.add.post");

    Route::post("task/list",[TaskManager::class,"listTask"])->name("task.list");
    Route::get("task/status/{id}",[TaskManager::class,"updateTaskStatus"])->name("task.status.update");

    Route::get("task/delete/{id}",[TaskManager::class,"deleteTask"])->name("task.delete");

    Route::get("task/edit/{id}", [TaskManager::class, "editTask"])->name("task.edit");  
    Route::post("task/update/{id}", [TaskManager::class, "updateTask"])->name("task.update");

    Route::get("task/undo/{id}", [TaskManager::class, "undoTaskStatus"])->name("task.status.undo");

});