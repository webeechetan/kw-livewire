<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\{Task, User , Project , Client, Team, Attachment, Comment};
use Livewire\WithFileUploads;
use App\Notifications\UserMentionNotification;


class View extends Component
{
    use WithFileUploads;

    public $task;
    public $users = [];
    public $selectedUsers = [];
    public $selectedNotifiers = [];
    public $projects = [];
    public $project_id;
    public $name;
    public $description;
    public $due_date;
    public $status;
    public $attachments = [];
    public $comment;

    public function render()
    {
        return view('livewire.tasks.view');
    }

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->name = $task->name;
        $this->selectedUsers = $task->users->pluck('id')->toArray();
        $this->selectedNotifiers = $task->notifiers->pluck('id')->toArray();
        $this->project_id = $task->project_id;
        $this->users = User::orderBy('name')->get();
        $this->projects = Project::orderBy('name')->get();
        $this->description = $task->description;
        $this->due_date = $task->due_date;
        $this->status = $task->status;
    }

    public function saveTask(){
        $this->validate([
            'name' => 'required',
        ]);

        $this->task->update([
            'name' => $this->name,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'project_id' => $this->project_id,
        ]);

        $this->task->users()->sync($this->selectedUsers);
        $this->task->notifiers()->sync($this->selectedNotifiers);

        // if(!empty($this->attachments)){
        //     foreach($this->attachments as $attachment){
        //         $attachment->storeAs('attachments', $attachment->getClientOriginalName());
        //         Attachment::create([
        //             'task_id' => $this->task->id,
        //             'file' => $attachment->getClientOriginalName(),
        //         ]);
        //     }
        // }

        if($this->attachments){ 
            foreach($this->attachments as $attachment){
                $p = Project::find($this->task->project_id);
                $c = Client::find($p->client_id);
                $path = session('org_name').'/'.$c->name.'/'.$p->name;
                $path = $attachment->store($path);
                $at = new Attachment();
                $at->org_id = session('org_id');
                $at->name = $attachment->getClientOriginalName();
                $at->attachment_path = $path;
                $at->attachable_id = $this->task->id;
                $at->attachable_type = 'App\Models\Task';
                $at->save();
            }
        } 

        session()->flash('message', 'Task updated successfully');
    }

    public function saveComment($type = 'internal'){
        // dd($this->comment);
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

        $mentioned_users = array_unique($mentioned_users);

        $mentioned_users = array_map('trim',$mentioned_users);

        $mentioned_users = array_filter($mentioned_users);

        // get user ids from mentioned users

        $mentioned_user_ids = User::whereIn('name',$mentioned_users)->pluck('id')->toArray();

        $comment->mentioned_users = implode(',',$mentioned_user_ids);
        $comment->type = $type;
        $comment->save();
        foreach($mentioned_user_ids as $user_id){
            $user = User::find($user_id);
            if($user){
                $user->notify(new UserMentionNotification($this->task , $comment));
            }
        }
        
        return $this->redirect(route('task.view', $this->task->id));

    }
}  
