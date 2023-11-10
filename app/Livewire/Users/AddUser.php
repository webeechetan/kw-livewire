<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;

class AddUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $projects = [];
    public $project_id;
    

    public function render()
    {
        return view('livewire.users.add-user');
    }

    public function mount()
    {
        $this->projects = Project::all();
    }

    public function rendered($view,$html){
        $this->dispatch('loadProjects');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $user = new User();
        $user->org_id = auth()->guard('orginizations')->user()->id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();

        session()->flash('success','User created successfully');

        return $this->redirect(route('user.index'), navigate:true);
    }
}
