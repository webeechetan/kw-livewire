<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class ListRole extends Component
{
    public $roles = [];

    public function render()
    {
        return view('livewire.roles.list-role');
    }

    public function mount(){
        $this->roles = Role::where('org_id',session('org_id'))->get();
    }
}
