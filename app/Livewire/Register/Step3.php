<?php

namespace App\Livewire\Register;

use Livewire\Component;
use App\Models\Organization;
use App\Models\OrganizationDetail;
use Illuminate\Support\Facades\Auth;


class Step3 extends Component
{

    public $facebook = '';
    public $twitter = '';
    public $linkedin = '';
    public $instagram = '';
    public $youtube = '';
    public $tiktok = '';
    public $emailSended = false;

    public function render()
    {
        return view('livewire.register.step3')->layout('auth.step3');
    }

    public function moveNext(){
        $org = OrganizationDetail::updateOrCreate(
            ['org_id' => Auth::user()->org_id],
            [
                'facebook' => $this->facebook,
                'twitter' => $this->twitter,
                'linkedin' => $this->linkedin,
                'instagram' => $this->instagram,
                'youtube' => $this->youtube,
                'tiktok' => $this->tiktok,
            ]
        );

        $this->emailSended = true;

        $this->dispatch('email-sended');
 
    }

    
    public function movePrev(){
        return $this->redirect(route('register.step2'));
    }
}
