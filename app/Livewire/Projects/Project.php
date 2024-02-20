<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project as ProjectModel;

class Project extends Component
{

    public $project;

    public function render()
    {
        return view('livewire.projects.project');
    }

    public function mount($id){ 
        $this->project = ProjectModel::withTrashed()->with('client')->find($id);
    }

    public function changeDueDate($date){
        $this->project->due_date = $date;
        $this->project->save();
        // $this->dispatch('success','Due date changed successfully');
        $this->redirect(route('project.profile',['id'=>$this->project->id]), navigate: true);
    }
}
 