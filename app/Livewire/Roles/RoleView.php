<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleView extends Component
{
    public $role;
    public $role_users = [];
    
    public function render()
    {
        $this->authorize('View Role');
        return view('livewire.roles.role-view');
    }

    public function mount(Role $role)
    {
        $this->role = $role;
        // $this->role_users = $role->users;
        // dd($this->role_users);
    }
}
