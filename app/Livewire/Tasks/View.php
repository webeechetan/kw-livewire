<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\{Task, User , Project , Client, Team, Attachment, Comment};
use Livewire\WithFileUploads;

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
}  
