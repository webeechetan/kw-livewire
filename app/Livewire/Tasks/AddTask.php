<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Team;


class AddTask extends Component
{
    public $name;
    public $description;
    public $dueDate;

    public $users;
    public $projects;
    public $teams;
    public $team_id;
    public $user_ids;

    public function render()
    {
        return view('livewire.tasks.add-task');
    }

    public function mount(){
        $this->users = User::all();
        $this->projects = Project::all();
        $this->teams = Team::all();
    }

    public function store(){
        $this->validate([
            'name' => 'required'
        ]);

        $task = new Task();
        $task->org_id = session('org_id');
        $task->assigned_by = auth()->guard(session('guard'))->user()->id;
        $task->team_id = $this->team_id;
        $task->name = $this->name;
        $task->description = $this->description;
        $task->due_date = $this->dueDate;
        $task->status = 'pending';
        $task->save();

        $task->users()->attach($this->user_ids);
        session()->flash('message','Task created successfully');
        $this->redirect(route('task.index'),navigate:true);
    }
}
