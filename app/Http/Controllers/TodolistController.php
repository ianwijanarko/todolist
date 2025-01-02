<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodolistService;

class TodolistController extends Controller
{

    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todoList(Request $request){
        $todolist = $this->todolistService->getTodolist();
        return response()->view('todolist.todolist', [
            "Title" => "Todolist",
            "todolist" => $this->todolistService->getTodolist()
        ]);

    }

    public function addTodo(request $request){
        $todo = $request->input('todo');
        $todolist = $this->todolistService->getTodolist();
        if(empty($todo)){
            return response()->view ('todolist.todolist', [
                "Title" => "Todolist",
                "todolist" => $todolist,
                "message" => "Todo cannot be empty"
            ]);

        }

        $this->todolistService->saveTodo(uniqid(),$todo);

        return redirect()->action([TodolistController::class, 'todoList']);

    }

    public function deleteTodo(string $todoId){
        $this->todolistService->deleteTodo($todoId);
        return redirect()->action([TodolistController::class, 'todoList']);
    }



}
