<?php

namespace App\Observers\Task;
use App\Models\Task;
use App\Notifications\TaskStatusChangeNotification;

class TaskObserver
{
    
    public function updating(Task $task){
        // check for if task status is changed
        
        if($task->isDirty('status')){
            $oldStatus = $task->getOriginal('status');
            $newStatus = $task->status;
            $changedBy = auth()->guard(session('guard'))->user();
            foreach($task->users as $user){
                $user->notify(new TaskStatusChangeNotification($task, $oldStatus, $newStatus, $changedBy));
            }
        }
    }

}
