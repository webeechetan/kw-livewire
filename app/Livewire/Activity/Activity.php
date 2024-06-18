<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Project as ProjectModel;
use App\Models\OrganizationActivity;
use Livewire\withFileUploads;

class Activity extends Component
{
    public $activity;

    public function render()
    {
        return view('livewire.activity.activity');
    }

    public function mount($id)
    {
        $this->activity = OrganizationActivity::find($id);
    }

}
