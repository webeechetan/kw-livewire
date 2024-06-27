<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Project as ProjectModel;
use App\Models\OrganizationActivity;
use App\Models\OrganizationActivityTask;
use Livewire\withFileUploads;

class Activity extends Component
{
    public $organizationActivity;
    public $activity;
    public $activityMembers;
    public $description;

    public function render()
    {
        return view('livewire.activity.activity');
    }

    public function mount(OrganizationActivity $organizationActivity)
    {
        $this->activity = $organizationActivity;
        //  dd($this->activity->countUsers->count());
        // // // dd($this->activityMembers->count());

    }

    public function updateDescription(){
        $this->activity->description = $this->description;
        $this->activity->save();
    }

}
