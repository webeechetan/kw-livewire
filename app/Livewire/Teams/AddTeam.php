<?php

namespace App\Livewire\Teams;

use Livewire\Component;
use App\Models\Team;
use App\Models\User;

class AddTeam extends Component
{
    public $users = [];
    public $user_ids = [];

    public $name;
    public $description;

    public function render()
    {
        return view('livewire.teams.add-team');
    }

    public function mount()
    {
        $this->users = User::where('org_id',auth()->guard('orginizations')->user()->id)->get();
    }

    public function store(){
        $this->validate([
            'name' => 'required',
        ]);

        $team = new Team();
        $team->name = $this->name;
        $team->description = $this->description;
        $team->org_id = session('org_id');
        $team->save();

        $team->users()->attach($this->user_ids);

        session()->flash('success','Team created successfully');

        return $this->redirect(route('team.index'), navigate: true);
    }
}
