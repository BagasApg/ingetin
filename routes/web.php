<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodolistController;

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

Route::get('/', [TodolistController::class, 'index']);
// Route::get('/todos', [TodoController::class, 'show']);

// show todos
Route::get('/getlistoftodos/{id}', [TodoController::class, 'getTodos'])->name('get-todos');

// show todo description
Route::get('/getdescoftodo/{id}', [TodoController::class, 'getDescription']);

// ajax create todo
Route::post('/process-createnewtodo', [TodoController::class, 'createTodo'])->name('create-todo');

//ajax auto-update
Route::post('/process-data-date/{id}', [TodoController::class, 'updateDate'])->name('process-data-date');
Route::post('/process-data-description/{id}', [TodoController::class, 'updateDescription'])->name('process-data-description');
Route::post('/process-data-status/{id}', [TodoController::class, 'updateStatus'])->name("process-data-status");
Route::post('/process-data-name/{id}', [TodoController::class, 'updateName'])->name("process-data-name");

// CRUD list
Route::post('/create-list', [TodolistController::class, 'store'])->name('create-list');
Route::post('/edit-list/{id}', [TodolistController::class, 'update'])->name('edit-list');
Route::delete('/delete-list/{id}', [TodolistController::class, 'delete'])->name('delete-list');

// CRUD todo
Route::delete('/delete-todo/{id}', [TodoController::class, 'deleteTodo'])->name('delete-todo');


// auth
Route::get('/login', [LoginController::class, 'index'])->name('login-index');
