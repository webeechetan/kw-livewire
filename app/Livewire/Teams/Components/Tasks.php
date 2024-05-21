<?php

namespace App\Livewire\Teams\Components;

use Livewire\Component;
use App\Models\Team;

class Tasks extends Component
{
    public $team;
    public function render()
    {
        return view('livewire.teams.components.tasks');
    }
    public function mount(Team $team) {}
}
