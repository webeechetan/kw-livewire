<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project as ProjectModel;
use App\Models\User;
use App\Models\Task;

class Project extends Component
{

    public $project;
    public $users;

    public function render()
    {
        return view('livewire.projects.project');
    }

    public function mount($id){ 
        $this->project = ProjectModel::withTrashed()->with('client')->find($id);
        $this->users = User::all();
    }

    public function changeDueDate($date){
        $this->project->due_date = $date;
        $this->project->save();
        // $this->dispatch('success','Due date changed successfully');
        $this->redirect(route('project.profile',['id'=>$this->project->id]), navigate: true);
    }

    public function updateDescription($description){
        $this->project->description = $description;
        $this->project->save();
    }

    public function syncUsers($users){
        $this->project->users()->sync($users);
        $this->dispatch('user-synced','Users synced successfully');
    }
}
 