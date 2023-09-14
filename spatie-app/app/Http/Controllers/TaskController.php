<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Creating Task
     */
    public function assignTask(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'comments' => 'required',            
        ]);
        $task = Task::create([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'comments' => $request->input('comments'),
            'user_id' => $request->input('user_id'),
        ]);
        if (! $task){
            return response()->json([
                'message'=> 'Failed to create a new Team'
            ]);
        }
        return response()->json([
            'message' => 'Task Created Successfully'
        ]);
    }


    /**
     * Display the tasks.
     */
    public function show(Task $task)
    {
        return response()->json([
            'message' => 'success',
            'data' => Task::all(),
        ]);
    }


    /**
     * Update the tasks.
     */
    public function Update_task(Request $request)
    {
        $task = Task::find($request->id);
        $task->name = empty($request->name) ? $task->name : $request->name;
        $task->status = empty($request->status) ? $task->status : $request->status;
        $task->comments = empty($request->comment) ? $task->comment : $request->comment;
        $task->user_id = empty($request->user_id) ? $task->user_id : $request->user_id;

        $task->save();

        return response()->json([
            'message' => "Task Updated Successfully"
        ]);
    }


    /**
     * Re-assigning the tasks.
     */
    public function reassign_task(Request $request)
    {
        $id = $request->id;
        $task = Task::find($id);

        $task->user_id = $request->user_id;
        $task->save();

        return response()->json([
            'message' => "Task Re-Assigned Successfully"
        ]);
    }


    /**
     * Delete the task
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $task = Task::find($id);
        $task->delete();

        return response()->json(['message' => 'Task Deleted Duccessfully']);
    }
}