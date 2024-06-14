<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\OrganizationActivity;

class ListActivity extends Component
{
    protected $listeners = ['activity-added' => 'mount'];

    public $activities;

    public function render()
    {
        return view('livewire.activity.list-activity');
    }

    public function mount()
    {
        $this->activities = OrganizationActivity::all();
    }
}
