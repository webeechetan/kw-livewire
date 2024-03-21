<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AddRole extends Component
{
    public $role_name;

    public $permissions = [];

    public $selected_permissions = [];

    protected $listeners = [];

    public function render()
    {
        return view('livewire.components.add-role');
    }

    public function mount(){
        $this->permissions = Permission::all();
    }

    public function addRole(){
        $this->validate([
            'role_name' => 'required'
        ]);

        $role = Role::create(['name' => $this->role_name,'org_id' => session('org_id')]);

        // foreach($this->selected_permissions as $permission){
        //     $role->givePermissionTo($permission);
        // }

        $this->dispatch('role-added');
    }
}
