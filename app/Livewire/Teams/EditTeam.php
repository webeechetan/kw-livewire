<?php

namespace App\Livewire\Teams;

use Livewire\Component;
use App\Models\Team;
use App\Models\User;
use App\Helpers\Helper;

class EditTeam extends Component
{

    public $team;
    public $name;
    public $description;
    public $users;
    public $selectedUsers = [];
    public $user_ids;

    public function render()
    {
        return view('livewire.teams.edit-team');
    }

    public function mount($id)
    {
        $this->team = Team::find($id);
        $this->name = $this->team->name;
        $this->description = $this->team->description;
        $this->users = User::all();
        $this->selectedUsers = $this->team->users->pluck('id')->toArray();
    }

   public function updateTeam(){
        $this->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3',
        ]);

        $team = Team::find($this->team->id);
        $team->name = $this->name;
        $team->description = $this->description;
        $team->image = Helper::createAvatar($team->name,'teams');
        $team->save();

        $this->team->users()->sync($this->user_ids);

        session()->flash('success','Team updated successfully');
        return $this->redirect(route('team.index'),navigate: true);
   }

}
