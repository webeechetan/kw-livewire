<?php

namespace App\Livewire\Register;

use App\Models\Organization;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\OrganizationDetail;
use Illuminate\Support\Facades\Auth;

class Step2 extends Component
{
    use WithFileUploads;

    public $image;
    public $org;
    public $industry_type;

    public function render()
    {
        return view('livewire.register.step2')->layout('auth.step2');
    }

    public function mount()
    {
        $this->org = Organization::where('id', auth()->user()->org_id)->first();
    }

    public function saveCroppedImage($tmpUploadedFileName)
    {
        $org = Organization::find(auth()->user()->org_id);
        $org->image = 'images/organizations/'.$tmpUploadedFileName;
        if($tmpUploadedFileName){
            
            $this->image->storeAs('images/organizations', $tmpUploadedFileName, 'public');
            $org->image = 'images/organizations/'.$tmpUploadedFileName;
            $org->save();
            $this->dispatch('success', 'Profile image updated successfully.');
        }
    }

    public function moveNext(){
        $org = OrganizationDetail::updateOrCreate(
            ['org_id' => Auth::user()->org_id],
            [
                'industry' => $this->industry_type
            ]
        );

        return $this->redirect(route('register.step3'));

    }
    
    public function movePrev(){
        return $this->redirect(route('register.step1'));
    }


}
