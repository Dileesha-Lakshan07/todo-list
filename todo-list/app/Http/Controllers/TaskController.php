<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function getTask(){
        return response()->json(Task::latest()->get());
    }


    public function storeTask(Request $request)
    {
        // Validate request
        $request->validate([
            'title'  => 'required|string|max:255',
            'date'   => 'required|date',
            'time'   => 'required',
            'detail' => 'nullable|string',
        ]);

        // Store task
        Task::create([
            'title'  => $request->title,
            'date'   => $request->date,
            'time'   => $request->time,
            'detail' => $request->detail,
        ]);

        return response()->json(['message' => 'Task stored successfully'], 201);
    }

    public function updateTask(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'title'  => 'required|string|max:255',
            'date'   => 'required|date',
            'time'   => 'required',
            'detail' => 'nullable|string',
        ]);

        // Store task
        Task::where('id', $id)->update([
            'title'  => $request->title,
            'date'   => $request->date,
            'time'   => $request->time,
            'detail' => $request->detail,
        ]);

        return response()->json(['message' => 'Task updated successfully'], 201);
    }

    public function deleteTask($id){
        Task::where('id', $id)->delete();
        return response()->json(['message' => 'Task deleted successfully'], 201);
    }
}



