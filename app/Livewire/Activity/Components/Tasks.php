<?php

namespace App\Livewire\Activity\Components;

use Livewire\Component;
use App\Models\OrganizationActivity;
use App\Models\OrganizationActivityTask;

class Tasks extends Component
{
    protected $listeners = ['saved' => 'refresh'];

    public $organizationActivity;
    public $activity;
    public $tasks = [];

    public $users = [];
    public $teams = [];

    public $sort = 'all';
    public $filter = 'all';
    public $byUser = 'all';
    public $byTeam = 'all';
    public $status = 'all';

    public $startDate;
    public $dueDate;

    public $query = '';

    public function render()
    {
        return view('livewire.activity.components.tasks');
    }

    public function mount(OrganizationActivity $organizationActivity)
    {
        $this->activity = $organizationActivity;
        $this->tasks = OrganizationActivityTask::where('organization_activity_id', $organizationActivity->id)->get();
    }

    public function refresh(){
        $this->tasks = OrganizationActivityTask::where('organization_activity_id', $this->activity->id)->get();
    }

    public function emitEditTaskEvent($id){
        $this->dispatch('editTask', $id);
    }
    public function doesAnyFilterApplied(){
        if($this->sort != 'all' || $this->byUser != 'all' || $this->startDate || $this->dueDate || $this->status != 'all'){
            return true;
        }
        return false;
    }
}
