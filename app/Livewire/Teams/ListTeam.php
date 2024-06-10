<?php

namespace App\Livewire\Teams;

use Livewire\Component;
use App\Models\Team;
use App\Models\User;
use Livewire\WithPagination;
use App\Models\Project;
use App\Models\Client;
use App\Models\Task;
use Livewire\Attributes\Lazy;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class ListTeam extends Component
{
    use WithPagination;

    protected $listeners = ['team-added' => 'refresh'];

    public $allTeams;
       
    public $query = '';

    public $sort = 'all';
    public $filter = 'all';
    public $byUser = 'all'; 


    public $team_members = [];
    public $team_projects = [];
    public $team_tasks = [];
    public $team_clients = [];
    public $team;
    public $users;

    public function render()
    {
        $this->allTeams = Team::count();
        $teams = Team::where('name', 'like', '%'.$this->query.'%');

        if($this->sort == 'newest'){
            $teams->orderBy('created_at','desc');
        }elseif($this->sort == 'oldest'){
            $teams->orderBy('created_at','asc');
        }elseif($this->sort == 'a_z'){
            $teams->orderBy('name','asc');
        }elseif($this->sort == 'z_a'){
            $teams->orderBy('name','desc');
        }

        if($this->byUser != 'all'){

            $teams->whereHas('users',function($query){
                $query->where('user_id',$this->byUser);
            });
        }

        $teams->orderBy('created_at', 'desc');
        $teams = $teams->paginate(12);

        return view('livewire.teams.list-team',[
            'teams' => $teams,
        ]);
    } 


    public function mount(){
        $this->authorize('View Team');
        $this->users = User::all();
    }

    public function refresh(){
        $this->mount();
    }


    public function search(){
        $this->resetPage();
    }

    public function doesAnyFilterApplied(){
        return  $this->byUser != 'all'  || $this->sort != 'all' || $this->filter != 'all';
    }


}

