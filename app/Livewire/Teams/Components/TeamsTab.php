<?php

namespace App\Livewire\Teams\Components;

use Livewire\Component;
use App\Models\Team;

class TeamsTab extends Component
{
    public $team;
    public function render()
    {
        return view('livewire.teams.components.teams-tab');
    }

    public function forceDeleteTeam($id)
    {

        $team = Team::withTrashed()->find($id);
        $team->forceDelete();
        $this->dispatch('success', 'Team deleted successfully.');
        $this->redirect(route('team.index'),navigate:true);
    }
    
}
