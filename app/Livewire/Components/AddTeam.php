<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Team;
use App\Models\User;

class AddTeam extends Component
{
    use WithFileUploads;

    protected $listeners = ['editTeam', 'editTeam'];

    public $name;
    public $image;
    public $team_users = [];
    public $team_manager;

    public $users = [];

    // edit

    public $team;

    public function render()
    {
        return view('livewire.components.add-team');
    }

    public function mount(){
        $this->users = User::orderBy('name')->get();
    }

    public function addTeam(){

        if($this->team){
            $this->updateTeam();
        }

        $this->validate([
            'name' => "required"
        ]);

        $team = new Team();
        $team->org_id = session('org_id');
        $team->name = $this->name; 
        $team->manager_id = $this->team_manager; 
        if($team->save()){
            $team->users()->sync($this->team_users);
        }

        $this->dispatch('success', 'Team added successfully');
        $this->dispatch('team-added');
        $this->dispatch('saved');
    }

    public function editTeam($id){
        $this->team = Team::find($id);
        $this->name = $this->team->name;
        $this->team_manager = $this->team->manager_id;
        $this->team_users = $this->team->users->pluck('id')->toArray();
        $this->dispatch('editTeamEvent',$this->team);
    }

    public function updateTeam(){
        $this->validate([
            'name' => "required"
        ]);

        $team = Team::find($this->team->id);
        $team->name = $this->name; 
        $team->manager_id = $this->team_manager; 
        if($team->save()){
            $team->users()->sync($this->team_users);
        }

        $this->dispatch('success', 'Team updated successfully');
        $this->dispatch('team-updated');
        $this->dispatch('saved');
    }

}
