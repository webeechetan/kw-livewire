<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\OrganizationActivity;
use Livewire\WithPagination;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use Illuminate\Support\Facades\Auth;

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
      
        // $this->activities = OrganizationActivity::all();
        $this->activities = OrganizationActivity::where('org_id', Auth::user()->org_id)->get();

        
    
    }

    public function search()
    {
        $this->resetPage();
    }
}
