<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Team;
use App\Helpers\Helper;

class AddUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $designation;
    public $teams = [];
    public $selectedTeams = [];


    public function render()
    {
        return view('livewire.components.add-user');
    }

    public function mount()
    {
        $this->teams = Team::all();
    }

    public function addUser(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->designation = $this->designation;
        $user->color = Helper::colors()[rand(0,5)];
        $user->org_id = session('org_id');
        $user->created_by = session('user')->id;
        $user->save();
        $user->teams()->sync($this->selectedTeams);
        $this->dispatch('saved');
        $this->dispatch('user-added');
    }
}
