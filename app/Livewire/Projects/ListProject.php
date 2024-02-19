<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;


class ListProject extends Component
{
    use WithPagination;

    public $query = '';

    public function render()
    {
        return view('livewire.projects.list-project',[
            'projects' => Project::where('name','like','%'.$this->query.'%')
            ->orWhere('description','like','%'.$this->query.'%')
            ->whereHas('client',function($query){
                $query->where('name','like','%'.$this->query.'%');
            })
            ->paginate(2)
        ]);
    }

    public function search(){
        $this->resetPage();
    }

    public function emitEditEvent($projectId)
    {
        $this->dispatch('editProject', $projectId);
    }

    public function emitDeleteEvent($projectId)
    {
        $this->dispatch('deleteProject', $projectId);
    }

    public function emitRestoreEvent($projectId)
    {
        $this->dispatch('restoreProject', $projectId);
    }

    public function emitForceDeleteEvent($projectId)
    {
        $this->dispatch('forceDeleteProject', $projectId);
    }
}
