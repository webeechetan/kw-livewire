<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleView extends Component
{
    public function render()
    {
        $this->authorize('View Role');
        return view('livewire.roles.role-view');
    }
}
