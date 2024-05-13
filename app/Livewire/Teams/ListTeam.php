<?php

namespace App\Livewire\Teams;

use Livewire\Component;
use App\Models\Team;
use App\Models\User;
use Livewire\WithPagination;
use App\Models\Project;
use App\Models\Client;
use App\Models\Task;

class ListTeam extends Component
{
    use WithPagination;

    // public $teams = [];
    public $team_members = [];
    public $team_projects = [];
    public $team_tasks = [];
    public $team_clients = [];

    public function render()
    {

        // $teams = Team::paginate(10);

        return view('livewire.teams.list-team',[
            'teams' => Team::paginate(10)
        ]);
    }
}

