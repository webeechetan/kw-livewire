<?php

namespace App\Livewire\Teams\Components;

use Livewire\Component;

class TeamsTab extends Component
{
    public $team;
    public function render()
    {
        return view('livewire.teams.components.teams-tab');
    }
}
