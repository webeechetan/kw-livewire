<?php

namespace App\Observers\Task;
use App\Models\Task;
use App\Models\Comment;
use App\Notifications\Task\NewCommentNotification;

class CommentObserver
{
    public function created(Comment $comment){
        $task = Task::find($comment->task_id);
        $users = $task->users;
        $users->each(function($user) use ($comment, $task){
            $user->notify(new NewCommentNotification($comment,$task));
        });
    }
}
