<?php

namespace App\Livewire\Projects\Components;

use Livewire\Component;
use App\Models\Project;

class ProjectTabs extends Component
{
    public $project;

    public function render()
    {
        $this->authorize('View Project');
        return view('livewire.projects.components.project-tabs');
    }

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function emitEditProjectEvent($id){
        $this->dispatch('editProject',$id);
    }

    public function emitDeleteProjectEvent($id){
        $this->dispatch('deleteProject',$id);
    }

    public function changeProjectStatus($status){
        $this->project->status = $status;
        $this->project->save();
        $this->dispatch('success','Project status changed successfully');
    }
}
