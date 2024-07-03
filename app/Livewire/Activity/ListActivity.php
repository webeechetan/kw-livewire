<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\OrganizationActivity;
use Livewire\WithPagination;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class ListActivity extends Component
{

    
    use WithPagination;

    protected $listeners = ['activity-added' => 'mount'];

    public $activities;
    public $query = '';

    public $sort = 'all';
    public $status = 'all';

    public function render()
    {

        
        $activities = OrganizationActivity::where('name','like','%'.$this->query.'%');
        return view('livewire.activity.list-activity');
    }

    public function mount()
    {
        $this->activities = OrganizationActivity::all();
    }

    public function search()
    {
        $this->resetPage();
    }
}
