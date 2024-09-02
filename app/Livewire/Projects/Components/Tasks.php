<?php

namespace App\Livewire\Projects\Components;

use Livewire\Component;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\Team;
use Livewire\Attributes\On;
use App\Helpers\ProjectTaskFilter;

class Tasks extends Component
{ 

    protected $listeners = ['saved' => 'refresh'];

    public $project;

    public $users = [];
    public $teams = [];
    public $tasks = [];
    public $totalTasks = 0;

    public $sort = 'all';
    public $filter = 'all';
    public $byUser = 'all';
    public $byTeam = 'all';
    public $status = 'all';

    public $startDate;
    public $dueDate;

    public $query = '';

    public $perPage = 10;

    public function render() 
    {
        return view('livewire.projects.components.tasks');
    }

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->users = User::all();
        $this->teams = Team::all();
        $this->tasks = $this->applySort($project->tasks());
        $this->tasks = $this->tasks->where('name', 'like', '%' . $this->query . '%');
        $this->totalTasks = $this->tasks->count();
        $this->tasks = $this->tasks->take($this->perPage)->get();
    }

    public function loadMore(){
        $this->perPage += 10;
        $tasks = $this->applySort($this->project->tasks());
        $tasks = $tasks->where('name', 'like', '%' . $this->query . '%');
        // new 10 tasks
        $tasks = $tasks->skip($this->perPage - 10)->limit(10)->get();
        $this->tasks = $this->tasks->merge($tasks);

    }

    public function refresh()
    {
        $this->mount($this->project);
    }

    public function search(){
        $this->mount($this->project);
    }

    public function updatedSort($value)
    {
        $this->mount($this->project);
    }
    public function updatedStartDate($value)
    {
        $this->mount($this->project);
    }

    public function updatedDueDate($value)
    {
        $this->mount($this->project);
    }

    public function updatedByUser($value)
    {
        $this->mount($this->project);
    }

    public function updatedStatus($value)
    {
        $this->mount($this->project);
    }

    public function emitEditTaskEvent($id)
    {
        $this->dispatch('editTask', $id);
    }

    public function emitDeleteTaskEvent($id)
    {
        $this->dispatch('deleteTask', $id);
    }

    public function applySort($query)
    {
        return ProjectTaskFilter::filterTasks(
            $query, 
            $this->byUser, 
            $this->sort, 
            $this->startDate, 
            $this->dueDate, 
            $this->status
        );
    }

    public function doesAnyFilterApplied(){
        if($this->sort != 'all' || $this->byUser != 'all' || $this->startDate || $this->dueDate || $this->status != 'all'){
            return true;
        }
        return false;
    }
}
