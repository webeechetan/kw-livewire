<?php

namespace App\Livewire\Teams\Components;

use Livewire\Component;
use App\Models\Team;

class Projects extends Component
{ 
    public $team;
    public function render()
    {
        return view('livewire.teams.components.projects');
    }
    public function mount(Team $team){}
}
