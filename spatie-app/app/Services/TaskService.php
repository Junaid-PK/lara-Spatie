<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class TaskService
{
    public function postTask(array $data)
    {
        $name = $data['name'];
        $status = $data['status'];
        $comments = $data['comments'];
        $user_id = $data['user_id'];

        $task = Task::create([
            'name' => $name,
            'status' => $status,
            'comments' => $comments,
            'user_id' => $user_id,
        ]);
        return $task;
        
    }

    public function getTask()
    {
        $task=Task::paginate(15);
        return $task;       
    }
    public function showTask($id)
    {
        
        $task = Task::find($id);
        return $task;
       
    }

    public function updateTask($id, array $data)
    {

        $task = Task::find($id);

        // Update the task's attributes
        $task->name = $data['name'];
        $task->status = $data['status'];
        $task->comments = $data['comments'];
        $task->user_id = $data['user_id'];

        // Save the updated task
        $task=$task->save();
return $task;
       
    }

    public function reassignTask($id, array $data)
    {
        $task = Task::find($id);
        $task->user_id = $data['user_id'];
        $task=$task->save();
        return $task;
       
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task=$task->delete();
        return $task;
       
    }
}
?>