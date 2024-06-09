<?php

namespace App\Observers\Task;
use App\Models\Task;
use App\Notifications\TaskStatusChangeNotification;
use App\Models\Activity;

class TaskObserver
{
    
    public function updating(Task $task){
        // check for if task status is changed
        if($task->project_id == null){
            return;
        }

        if($task->isDirty('status')){
            $oldStatus = $task->getOriginal('status');
            $newStatus = $task->status;
            $changedBy = auth()->guard(session('guard'))->user();
            foreach($task->users as $user){
                $user->notify(new TaskStatusChangeNotification($task, $oldStatus, $newStatus, $changedBy));
            }
        }
    }

    public function created($task)
    {
        if($task->project_id == null){
            return;
        }
        $activity = new Activity();
        $activity->org_id = $task->org_id;
        $activity_text = auth()->guard(session('guard'))->user()->name.' created a task '.$task->name;
        $activity->text = $activity_text;
        $activity->activityable_id = $task->project_id;
        $activity->activityable_type = 'App\Models\Project';
        $activity->created_by = auth()->guard(session('guard'))->user()->id;
        $activity->save();
    }

}
