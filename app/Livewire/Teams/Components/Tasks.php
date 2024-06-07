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

    public $project_start_date = null;
    public $project_due_date = null;
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

    public $status = 'all';

    public function render()
    {
        return view('livewire.teams.components.tasks');
    }

    public function mount(Team $team) {
        $this->users = User::all();
        $this->projects = Project::all();
        $this->clients = Client::all();
        $this->teams = Team::orderBy('name')->get();
    }

    public function updatedByClient($value){
        $this->projects = Project::where('client_id', $value)->get();
    }

    public function updatedByProject($value){
        $project = Project::find($value);
        $this->users = $project->members;
    }
}
