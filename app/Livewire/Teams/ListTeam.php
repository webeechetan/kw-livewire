<?php

namespace App\Livewire\Teams;

use Livewire\Component;
use App\Models\Team;
use App\Models\User;
use Livewire\WithPagination;

class ListTeam extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.teams.list-team',[
            'teams' => Team::where('org_id',auth()->guard('orginizations')->user()->id)->paginate(10)
        ]);
    }
}
