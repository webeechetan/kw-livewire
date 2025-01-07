<?php

namespace App\Livewire\Teams\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Helper;
use App\Models\Team;
use Carbon\Carbon;
use Livewire\Attributes\Lazy;
use App\Models\{ Project, User, Client, Task };


class Tasks extends Component
{

    use WithPagination;
 
    public $totalTasks = 0;
    public $perPage = 15;
    public $startDate = null; 
    public $dueDate = null;
    public $allTasks; 
    public $activeTasks;
    public $completedTasks;
    public $overDueTasks;
    public $cancelledTasks;

    public $query = '';
    public $sort = 'all';

    public $team;
    public $byClient = 'all';
    public $byProject = 'all';
    public $byUser = 'all';
    public $filter = 'all';

    public $users = [];
    public $projects = [];
    public $clients = []; 
    public $teams = [];
    public $tasks = [];

    public $tasks_for_count = [];

    public $status = 'all';

    public function render()
    {
        return view('livewire.teams.components.tasks');
    } 

  
    public function mount(Team $team) {


        $this->doesAnyFilterApplied();
        $this->users = User::all();
        $this->projects = Project::all();
        $this->clients = Client::all();
        $this->teams = Team::orderBy('name')->get();
        $this->totalTasks = count($team->tasks);
        // $this->tasks = $team->tasks;
        // get $perPage tasks from the team $team->tasks is a array of tasks
        // $this->tasks = $team->tasks->take($this->perPage);
        // dd($this->tasks);
    }

    public function updatedByClient($value){
        $this->projects = Project::where('client_id', $value)->get();
    }

    public function updatedByProject($value){
        $project = Project::find($value);
        $this->users = $project->members;
    }

    public function updatedByUser($value){
        $user = User::find($value);
        $this->projects = $user->projects;
    }

    public function search()
    {
        // $this->resetPage();
    }

    public function doesAnyFilterApplied(){
        return $this->byClient != 'all' || $this->byProject != 'all' || $this->byUser != 'all' || $this->status != 'all' || $this->startDate || $this->dueDate;
    }

    public function loadMore(){
        $this->perPage += 10;
    }
}
