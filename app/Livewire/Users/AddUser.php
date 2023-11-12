<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AddUser extends Component
{
    use WithFileUploads, WithPagination;

    public $name;
    public $email;
    public $password;
    public $teams = [];
    public $team_ids;
    public $image;

    public function render()
    {
        return view('livewire.users.add-user');
    }

    public function mount()
    {
        $this->teams = Team::all();
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

        if($this->image){
            $this->validate([
                'image' => 'image|max:1024', // 1MB Max
            ]);

            $image = $this->image->store('public/images/users');
            $user->image = $image;
        }

        $user->password = Hash::make($this->password);
        $user->save();

        $user->teams()->attach($this->team_ids);

        session()->flash('success','User created successfully');

        return $this->redirect(route('user.index'), navigate:true);
    }
}
