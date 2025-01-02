<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


Route::get('/', [Controllers\HomeController::class, 'home']);

Route::view('/template', 'template');

Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::post('/login', 'doLogin')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::get('/logout', 'doLogout')->middleware([\App\Http\Middleware\OnlyMemberMidleware::class]);
});

Route::controller(App\Http\Controllers\TodolistController::class)->middleware([\App\Http\Middleware\OnlyMemberMidleware::class])->group(function () {
    Route::get('/todolist', 'todoList')->middleware([\App\Http\Middleware\OnlyMemberMidleware::class]);
    Route::post('/todolist', 'addTodo')->middleware([\App\Http\Middleware\OnlyMemberMidleware::class]);
    Route::post('/todolist/{todoId}/delete', 'deleteTodo')->middleware([\App\Http\Middleware\OnlyMemberMidleware::class]);
});