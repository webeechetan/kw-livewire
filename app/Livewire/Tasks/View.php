<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\{Task, User , Project , Client, Team, Attachment, Comment};

class View extends Component
{
    public $task;
    public $users = [];
    public $selectedUsers = [];
    public $selectedNotifiers = [];
    public $projects = [];
    public $project_id;
    public $name;

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
    }
}  
