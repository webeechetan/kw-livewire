<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\User;

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

        if(!$res){
            $res = Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password]);
            if($res){
                session()->put('guard','web');
                session()->put('org_id',User::where('email',$this->email)->first()->org_id);
            }
        }else{
            session()->put('guard','orginizations');
            session()->put('org_id',Organization::where('email',$this->email)->first()->id);
        }

        if($res){
            return $this->redirect(route('dashboard'),navigate: true);
        }else{
            session()->flash('error','Invalid email or password');
        }
    }
}
