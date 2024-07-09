<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Helpers\Helper;

class Register extends Component
{
    public $name;
    public $email;
    public $password;

    // registration journey properties
    public $companysize;
    public $step = 2;
    public $image;
    public $memberemail;
    public $organization;

    public function render()
    {
        return view('livewire.register')->layout('auth.register');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:organizations',
            'password' => 'required|min:6'
        ]);

        $organization = new Organization();
        $organization->name = $this->name;
        $organization->email = $this->email;
        $organization->password = Hash::make($this->password);

        try {
            $organization->save();
            // create folder for organization
            $path = public_path('storage/'.$organization->name);
            if(!file_exists($path)){
                mkdir($path, 0777, true);
            }
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->org_id = $organization->id;
            $user->image = Helper::createAvatar($this->name,'users');
            $user->save();

            $roles = [
                'Admin' => [
                    'Create Client',
                    'Edit Client',
                    'Delete Client',
                    'View Client',
                    'Create Project',
                    'Edit Project',
                    'Delete Project',
                    'View Project',
                    'Create User',
                    'Edit User',
                    'Delete User',
                    'View User',
                    'Create Team',
                    'Edit Team',
                    'Delete Team',
                    'View Team',
                    'Create Task',
                    'Edit Task',
                    'Delete Task',
                    'View Task',
                    'Create Role',
                    'Edit Role',
                    'Delete Role',
                    'View Role',
                ],
                'HR' => [
                    'Create User',
                    'Edit User',
                    'Delete User',
                    'View User',
                ],
                'Manager' => [
                    'Create Project',
                    'Edit Project',
                    'Delete Project',
                    'View Project',
                    'Create Team',
                    'Edit Team',
                    'Delete Team',
                    'View Team',
                    'Create Task',
                    'Edit Task',
                    'Delete Task',
                    'View Task',
                ],
                'Employee' => [
                    'View Project',
                    'View Team',
                    'View Task',
                ],
            ];
    
            $admin_id  = null;
    
            foreach ($roles as $role => $permissions) {
                $role = Role::create(['name' => $role, 'org_id' => $organization->id]);
                if($role->name == 'Admin'){
                    $admin_id = $role->id;
                }
                $role->syncPermissions(Permission::whereIn('name', $permissions)->get());
            }

            setPermissionsTeamId($organization->id);
            $user->assignRole($admin_id);

        } catch (\Throwable $th) {
            dd($th);
            return $this->alert('error', 'Something went wrong, please try again later');
        }


        
        
        return $this->redirect(route('login'),navigate: true);
    }
}
