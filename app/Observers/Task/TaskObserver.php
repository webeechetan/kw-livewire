<?php

namespace App\Observers\Task;
use App\Models\Task;
use App\Notifications\TaskStatusChangeNotification;
use App\Models\Activity;
use App\Models\Notification;

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

            if($oldStatus == 'completed'){
                $oldStatus = 'Completed';
            }else if($oldStatus == 'in_progress'){
                $oldStatus = 'In Progress';
            }else if($oldStatus == 'in_review'){
                $oldStatus = 'In Review';
            }else if($oldStatus == 'pending'){
                $oldStatus = 'Pending';
            }else{
                $oldStatus = 'Not Started';
            }
    
            if($newStatus == 'completed'){
                $newStatus = 'Completed';
            }else if($newStatus == 'in_progress'){
                $newStatus = 'In Progress';
            }else if($newStatus == 'in_review'){
                $newStatus = 'In Review';
            }else if($newStatus == 'pending'){
                $newStatus = 'Pending';
            }else{
                $newStatus = 'Not Started';
            }


            $changedBy = auth()->guard(session('guard'))->user();
            $taskUrl = env('APP_URL').'/'. session('org_name').'/task/view/'.$task->id;
            foreach($task->users as $user){
                $user->notify(new TaskStatusChangeNotification($task, $oldStatus, $newStatus, $changedBy, $taskUrl));
                $notification = new Notification();
                $notification->user_id = $user->id;
                $notification->org_id = $task->org_id;
                $notification->title = $changedBy->name.' changed the status of task '.$task->name .' from '.$oldStatus.' to '.$newStatus;
                $notification->message = $changedBy->name.' changed the status of task '.$task->name .' from '.$oldStatus.' to '.$newStatus;
                $notification->url = route('task.view', ['task' => $task->id]);
                $notification->save();
            }

            $activity = new Activity();
            $activity->org_id = $task->org_id;
            $activity_text = auth()->guard(session('guard'))->user()->name.' changed the status of task '.$task->name .' from '.$oldStatus.' to '.$newStatus;
            $activity->text = $activity_text;
            $activity->activityable_id = $task->project_id;
            $activity->activityable_type = 'App\Models\Project';
            $activity->created_by = auth()->guard(session('guard'))->user()->id;
            $activity->save();
            
        }
    }

    public function created(Task $task)
    {
        // create activity
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
