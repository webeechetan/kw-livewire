<?php

namespace App\Livewire\Teams\Components;

use Livewire\Component;
use App\Models\Team;
use App\Models\{ Project, User, Client };

class Tasks extends Component
{
    public $team;
    public $byClient = '';
    public $byProject = '';
    public $byUser = '';

    public $users;
    public $projects;
    public $clients;
    public $teams;
    public $tasks= [];

    public function render()
    {

        if($this->byClient != 'all'){

            dd($this->byClient);
            // select from project_user
           
        }

        if($this->byProject != 'all'){
            dd($this->byProject);
            // select from project_user
           
        }

        if($this->byUser != 'all'){
            dd($this->byUser);
           
        }

        




         return view('livewire.teams.components.tasks');
    }
    public function mount(Team $team) {

        $this->users = User::all();
        $this->projects = Project::all();
        $this->clients = Client::all();
        $this->teams = Team::orderBy('name')->get();
    }
}
