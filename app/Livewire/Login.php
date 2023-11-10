<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;

class Login extends Component
{
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.login')->layout('auth.login');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $res = Auth::guard('orginizations')->attempt(['email' => $this->email, 'password' => $this->password]);

        if($res){
            return $this->redirect(route('dashboard'),navigate: true);
        }else{
            session()->flash('error','Invalid email or password');
        }
    }
}
