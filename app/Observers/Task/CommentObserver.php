<?php

namespace App\Observers\Task;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Notification;
use App\Notifications\Task\NewCommentNotification;

class CommentObserver
{
    public function created(Comment $comment){
        $task = Task::find($comment->task_id);
        $users = $task->users;
        $taskUrl = env('APP_URL').'/'.session('org_name').'/task/view/'.$task->id;
        $users->each(function($user) use ($comment, $task, $taskUrl){
            $user->notify(new NewCommentNotification($comment,$task,$taskUrl));
            $notification = new Notification();
            $notification->user_id = $user->id;
            $notification->org_id = $task->org_id;
            $notification->title = 'You have a new comment on task '.$task->name;
            $notification->message = 'You have a new comment on task '.$task->name;
            $notification->url = route('task.view', ['task' => $task->id]);
            $notification->save();
        });
        
    }
}
