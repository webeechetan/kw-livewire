<?php

namespace App\Livewire\Register;

use Livewire\Component;
use App\Models\Organization;
use App\Models\OrganizationDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class Step1 extends Component
{

    public $for = 'agency';

    public function render()
    {
        return view('livewire.register.step1')->layout('auth.step1');
    }

    public function registerOrgFor($for){
        $org = Organization::where('id', Auth::user()->org_id)->first();
        $org->for = $for;
        $this->for = $for;
        $org->save();
    }

    public function moveNext(){
        return $this->redirect(route('register.step2'));
    }
}
