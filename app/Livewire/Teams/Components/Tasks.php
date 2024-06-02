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

    public $users;
    public $projects;
    public $clients;
    public $teams;
    public $tasks= [];

    public function render()
    {

        $this->allTasks = Task::count();
        $this->activeTasks = Task::whereNotIn('status', ['cancelled', 'completed'])->count();
        $this->completedTasks = Task::where('status', 'completed')->count();
        $this->overDueTasks = Task::where('due_date', '<', now())->count();
        $this->cancelledTasks = Task::where('status', 'cancelled')->count();

        //  $tasks = Task::all();

        $tasks = Task::where('name','like','%'.$this->query.'%');
        

        if($this->filter == 'active'){
            $tasks->whereNotIn('status', ['cancelled', 'completed']);
        }elseif($this->filter == 'completed'){
            $tasks->where('status','completed');
        }elseif($this->filter == 'overdue'){ 
            $tasks->where('due_date','<', Carbon::today());
        }

        if($this->byProject != 'all'){
            
            $tasks->whereHas('project', function($query){
                $query->where('project_id', $this->byProject);
            });
        }

        $tasks->orderBy('id','desc');
        $tasks = $tasks->paginate(12);
       
        return view('livewire.teams.components.tasks',[
            'tasks' => $tasks
        ]);

        //return view('livewire.teams.components.tasks');
    }

    public function mount(Team $team) {

        $this->users = User::all();
        $this->projects = Project::all();
        $this->clients = Client::all();
        $this->teams = Team::orderBy('name')->get();
    }
}
