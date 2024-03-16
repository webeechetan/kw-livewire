<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class ListUser extends Component
{
    public function render()
    {
        return view('livewire.users.list-user',[
            'users' => User::paginate(10)
        ]);
    } 
}
