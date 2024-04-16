<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\ { Project, Task, User, Attachment, Comment};
use Livewire\WithFileUploads;
use App\Notifications\NewTaskAssignNotification;

class AddTask extends Component
{
    use WithFileUploads;

    protected $listeners = ['editTask','deleteTask'];

    public $project;
    public $task;
    public $name;
    public $description;
    public $due_date;
    public $projects = [];
    public $users = [];
    public $task_users;
    public $task_notifiers;
    public $project_id;
    public $status = 'pending'; 

    public $attachments;
    public $comment;
    public $comments = [];

    public function render()
    {
        return view('livewire.components.add-task');
    }

    public function mount($project){
        $this->project = $project;
        $this->users = User::all();
        $this->projects = Project::all();
        $this->project_id = $project->id;
    }

    public function saveTask(){
        if($this->task){
            $this->updateTask();
            return;
        }
        $this->validate([
            'name' => 'required',
        ]);
        $task = new Task();
        $task->org_id = session('org_id');
        $task->assigned_by = auth()->guard(session('guard'))->user()->id;
        $task->name = $this->name;
        $task->description = $this->description;
        $task->due_date = $this->due_date;
        $task->project_id = $this->project_id;
        $task->status = $this->status;
        $task->save();
        $task->users()->sync($this->task_users);
        $task->notifiers()->sync($this->task_notifiers);
         // attach files to task from $this->attachments
        if($this->attachments){
            foreach($this->attachments as $attachment){
                $path = $attachment->store('attachments');
                $at = new Attachment();
                $at->org_id = session('org_id');
                $at->name = $attachment->getClientOriginalName();
                $at->attachment_path = $path;
                $at->attachable_id = $task->id;
                $at->attachable_type = 'App\Models\Task';
                $at->save();
            }
        }
 
        foreach($this->task_users as $user_id){
            $user = User::find($user_id);
            $user->notify(new NewTaskAssignNotification($task));
        }
        
        $this->dispatch('saved','Task saved successfully');
    }

    public function saveComment(){
        $this->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->task_id = $this->task->id;
        $comment->user_id = auth()->guard(session('guard'))->user()->id;
        $comment->comment = $this->comment;
        $comment->created_by = session('guard');

        // take out mentioned users from description and save them in mentioned_users array

        $mentioned_users = [];

        // remove paragraph tags from description

        $temp_comment = str_replace('<p>','',$this->comment);
        $temp_comment = str_replace('</p>','',$temp_comment);
        $temp_comment = strip_tags($temp_comment);


        // convert description to array of words

        $comment_array = explode(' ',$temp_comment);

        // check if any word starts with @

        foreach($comment_array as $word){
            if(substr($word,0,1) == '@'){
                $user_name = substr($word,1);
                $user_name = str_replace('_',' ',$user_name);
                $mentioned_users[] = $user_name;
            }
        }

        // get user ids from mentioned users

        $mentioned_user_ids = User::whereIn('name',$mentioned_users)->pluck('id')->toArray();

        foreach($mentioned_user_ids as $user_id){
            $user = User::find($user_id);
            // $user->notify(new UserMentionNotification($this->task , $comment));
        }

        $comment->mentioned_users = implode(',',$mentioned_user_ids);
        $comment->save();
        $this->comments = $this->task->comments;
        $this->dispatch('comment-added',Comment::with('user')->find($comment->id));
        $this->comment = '';

    }

    public function editTask($id){
        $this->task = Task::with('users','notifiers','attachments','comments.user')->find($id);
        $this->name = $this->task->name;
        $this->description = $this->task->description;
        $this->due_date = $this->task->due_date;
        $this->task_users = $this->task->users->pluck('id')->toArray();
        $this->task_notifiers = $this->task->notifiers->pluck('id')->toArray();
        $this->comments = $this->task->comments;
        $this->status = $this->task->status;
        $this->dispatch('edit-task',$this->task);
    }

    public function updateTask(){
        $this->validate([
            'name' => 'required',
        ]);
        $this->task->name = $this->name;
        $this->task->description = $this->description;
        $this->task->due_date = $this->due_date;
        $this->task->status = $this->status;
        $this->task->save();
        $this->task->users()->sync($this->task_users);
        $this->task->notifiers()->sync($this->task_notifiers);
        // attach files to task from $this->attachments
        if($this->attachments){ 
            foreach($this->attachments as $attachment){
                $path = $attachment->store('attachments');
                $at = new Attachment();
                $at->org_id = session('org_id');
                $at->name = $attachment->getClientOriginalName();
                $at->attachment_path = $path;
                $at->attachable_id = $this->task->id;
                $at->attachable_type = 'App\Models\Task';
                $at->save();
            }
        }

        $this->dispatch('saved','Task updated successfully');
    }

    public function changeProjectStatus($id){
        $project = Project::find($id);
        $project->status = !$project->status;
    }

    public function deleteTask(){
        $this->task->delete();
        $this->dispatch('success','Task deleted successfully');
        $this->dispatch('saved','Task deleted successfully');
    }

    public function viewFullscree(){
        $this->redirect(route('task.view',$this->task->id), navigate: true);
    }
    
}
