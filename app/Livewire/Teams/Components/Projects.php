<?php

namespace App\Livewire\Teams\Components;

use Livewire\Component;
use App\Models\{ Team, Project, Task, User, Client };

class Projects extends Component
{  
    public $team;
    public $clients;
    public $users;
    public $users_projects = [];
   
 

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
    }

    public function updatedFilterByClient($value){
        // $this->team->projects = $this->team->projects->filter(function($project) use ($value){
        //     return $project->client_id == $value;
        // });
    }
}
