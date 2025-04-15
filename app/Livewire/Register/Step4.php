<?php

namespace App\Livewire\Register;

use Livewire\Component;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Notifications\InviteUser;



class Step4 extends Component
{

    public $inviteEmails = '';
    public $emailSended = false;

    public function render()
    {
        return view('livewire.register.step4')->layout('auth.step4');
    }

    public function finishOnboarding()
    {

        // dd($this->inviteEmails);
        // ["a@gmail.com","b@gmail.com"] exa

        $emails = json_decode($this->inviteEmails);

        // Send invitations to the provided emails

        if($emails){
            foreach ($emails as $email) {
    
                $user = new User();
                $user->org_id = session('org_id');
                $user->name = strtok($email, '@');
                $user->email = $email;
                $user->created_by = session('user')->id;
                // generate random password which contains one uppercase, one lowercase, one number and one special character
                $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()'),0,8);
                $user->password = Hash::make($password);
                $user->save();
                $org = Organization::find(session('org_id'));
                $user->notify(new InviteUser($org,$password));
                $this->dispatch('saved');
                $this->dispatch('user-added');
    
            }
        }
        $this->emailSended = true;

        $this->dispatch('email-sended');
    }
}
