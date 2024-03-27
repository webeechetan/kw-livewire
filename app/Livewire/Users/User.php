<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User as UserModel;
use App\Models\Project;
use App\Models\Client;

class User extends Component
{
    public $user;
    public $user_clients = [];
    public $user_projects = [];

    public function render()
    {
        return view('livewire.users.user');
    }

    public function mount(UserModel $user)
    {
        $this->user = $user;
        $users_task_array = $this->user->tasks->groupBy('project_id');
        $this->user_clients = Project::whereIn('id',$users_task_array->keys())->get()->groupBy('client_id');
        $this->user_clients = Client::whereIn('id',$this->user_clients->keys())->get();
        $this->user_projects = Project::whereIn('id',$users_task_array->keys())->get();
        
    }

    public function emitEditUserEvent($user_id){
        $this->dispatch('editUser', $user_id);
    }
}
