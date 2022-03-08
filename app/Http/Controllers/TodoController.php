<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = todo::all();

        return view('index', [
            'tasks' => $todo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {   
        $todo = Todo::create([
            'task' => $request['task'],
            'confirmed' => false
        ]);

        return redirect()->route('todo.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Todo $todo)
    {
        // $item = Todo::find($todo['id']);

        if($todo->confirmed != 0)
        {
            $todo->confirmed = 0;
            $todo->save();
        }
        else
        {
            $todo->confirmed = 1;
            $todo->save();
        }

        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        
        return redirect()->route('todo.index');
    }
}