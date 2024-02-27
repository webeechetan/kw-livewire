<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\ { Project, Task, User, Attachment};
use Livewire\WithFileUploads;

class AddTask extends Component
{
    use WithFileUploads;

    protected $listeners = ['editTask'];

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

    public $attachments;

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
        $this->dispatch('saved','Task saved successfully');
        $this->redirect(route('project.profile',['id'=>$this->project->id]), navigate: true);
    }

    public function editTask($id){
        $this->task = Task::with('users','notifiers','attachments')->find($id);
        $this->name = $this->task->name;
        $this->description = $this->task->description;
        $this->due_date = $this->task->due_date;
        $this->task_users = $this->task->users->pluck('id')->toArray();
        $this->task_notifiers = $this->task->notifiers->pluck('id')->toArray();
        $this->dispatch('edit-task',$this->task);
    }

    public function updateTask(){
        $this->validate([
            'name' => 'required',
        ]);
        $this->task->name = $this->name;
        $this->task->description = $this->description;
        $this->task->due_date = $this->due_date;
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
        $this->redirect(route('project.profile',['id'=>$this->project->id]), navigate: true);
    }
    
}
