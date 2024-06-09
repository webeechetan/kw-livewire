<?php

namespace App\Livewire\Teams\Components;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\On; 
use App\Models\{ Team, Project, Task, User, Client };


class Projects extends Component
{  


    public $project_start_date = null;
    public $project_due_date = null;

    public $filter = 'all';
    public $team;
    public $clients;
    public $users;
    public $users_projects = [];
    public $query = '';
    public $sort = 'all';

    public $byClient = 'all';
    public $byUser = 'all';
    public $status = 'all';

    public $project;
 
    public $projects= [];

    // filters

    public $filterByClient = null;
    public $filterByUser = null;
    public $start_date = null;
    public $end_date = null;

    public function render()
    {
       return view('livewire.teams.components.projects');
    }
    

    public function mount(Team $team){
        $this->team = $team;
        $this->clients = Client::orderBy('name', 'asc')->get();
        $this->users = User::orderBy('name', 'asc')->get();
        $this->projects = $this->team->projects;
    }


    public function updatedFilter()
    {

        if($this->filter == 'overdue')
        {
            $this->projects = $this->team->projects()->where('due_date', '<', Carbon::now())->get();
        }else{
            if($this->filter != 'all'){
                if($this->filter == 'archived')
                {
                    $this->projects = $this->team->projects()->where('deleted_at', '!=', null)->get();
                }else{
                    $this->projects = $this->team->projects()->where('status', $this->filter)->get(); 
                }
            }else{
                $this->projects = $this->team->projects;
            }
        }
    }
    

  

    public function updatedFilterByClient($value){
        $client = Client::find($value);
        $this->users = $client->users;
    }
}
