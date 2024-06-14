<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\OrganizationActivity;
use Livewire\WithFileUploads;

class AddActivity extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $activity_image;
    public $start_date;
    public $end_date;
    public $status;

    public function render()
    {
        return view('livewire.components.add-activity');
    }

    public function addActivity(){
        $this->validate([
            'name' => 'required',
        ]);

        $activity = new OrganizationActivity();
        $activity->org_id = session('org_id');
        $activity->name = $this->name;
        $activity->description = $this->description;
        $activity->start_date = $this->start_date;
        $activity->due_date = $this->end_date;
        $activity->created_by = session('user')->id;
        if($this->activity_image){
            $image = $this->activity_image->store('images/activites');
            $image = str_replace('public/', '', $image);
            $activity->image = $image;
        }
        $activity->save();
        $this->dispatch('success', 'Activity Added Successfully');
        $this->dispatch('activity-added', $activity);
        $this->resetFrom();

    }

    public function resetFrom(){
        $this->name = null;
        $this->description = null;
        $this->activity_image = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->status = null;
    }


}
