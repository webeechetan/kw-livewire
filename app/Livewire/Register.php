<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;


class Register extends Component
{
    public $name;
    public $email;
    public $password;

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
        } catch (\Throwable $th) {
            return $this->alert('error', 'Something went wrong, please try again later');
        }
        
        
        return $this->redirect(route('login'),navigate: true);
    }
}
