<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTaskRequest;
use App\Http\Requests\PostTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\ReassignTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;


class TaskController extends Controller
{
    /**
     * Creating Task
     */
    public function postTasks(PostTaskRequest $request, TaskService $taskService)
    {
        $validated = $request->validated();
        $task = $taskService->postTask($validated);
        if (!$task) {
            return response()->json([
                'message' => 'Failed to create task'
            ]);
        }
        return response()->json([
            'message' => 'Task Created Successfully'
        ],200);
    }
    /**
     * Display the tasks.
     */
    public function getTasks(GetTaskRequest $request, TaskService $taskService)
    {
        $task= $taskService->getTask();
        return response()->json([
            'message' => 'success',
            'data' => $task,
        ],200);
       
    }
    public function showTasks($id, TaskService $taskService)
    {
        $task = $taskService->showTask($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($task);
    }



    public function updateTasks($id, UpdateTaskRequest $request, TaskService $taskService)
    {

        $validated = $request->validated();
        $task = $taskService->updateTask($id, $validated);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        else{
            return response()->json([
                'message' => "Task Updated Successfully"
            ],200);
        }

    }

    /**
     * Re-assigning the tasks.
     */
    public function reassignTasks($id, ReassignTaskRequest $request, TaskService $taskService)
    {
        $validated = $request->validated();
        $task = $taskService->reassignTask($id, $validated);
        return response()->json([
            'message' => "Task Re-Assigned Successfully"
        ]);
    }


    /**
     * Delete the task
     */
    public function deleteTasks($id, TaskService $taskService)
    {
        $task = $taskService->deleteTask($id);
        
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        else{
            return response()->json(['message' => 'Task Deleted Duccessfully'],200);
        }
       
    }
}