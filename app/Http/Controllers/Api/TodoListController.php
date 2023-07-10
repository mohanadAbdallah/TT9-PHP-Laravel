<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{

    public function index()
    {
        return TodoList::all();
    }


    public function store(TodoListRequest $request)
    {
        $todoList = TodoList::create($request->validated());
        return response()->json(['data' => $todoList],201);
    }

    public function show(TodoList $todoList)
    {
        return response()->json(['data'=>$todoList],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoList $todoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TodoList $todoList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoList $todoList)
    {
        //
    }
}
