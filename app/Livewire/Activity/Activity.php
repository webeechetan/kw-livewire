<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Project as ProjectModel;
use App\Models\OrganizationActivity;
use Livewire\withFileUploads;

class Activity extends Component
{
    public $organizationActivity;
    public $activity;
    public $description;

    public function render()
    {
        return view('livewire.activity.activity');
    }

    public function mount(OrganizationActivity $organizationActivity)
    {
        $this->activity = $organizationActivity;
    }

    public function updateDescription(){
        $this->activity->description = $this->description;
        $this->activity->save();
    }

}
