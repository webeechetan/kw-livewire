<?php

namespace App\Livewire\Activity\Components;

use Livewire\Component;
use App\Models\Activity;

class ActivityTabs extends Component
{

    public $activity;

    public function render()
    {
        return view('livewire.activity.components.activity-tabs');
    }
}
