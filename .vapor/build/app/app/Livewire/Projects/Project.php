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

    public $sort = 'all';
    public $filter = 'all';
    public $byUser = 'all';
    public $byTeam = 'all';

    public function render()
    {
        return view('livewire.projects.project');
    }

    public function mount($id){ 
        $this->project = ProjectModel::withTrashed()->with('client')->find($id);
        if($this->sort == 'all'){
            $this->project->tasks = $this->project->tasks;
        }elseif($this->sort == 'a_z'){
            $this->project->tasks = $this->project->tasks->sortBy('name');
        }elseif($this->sort == 'z_a'){
            $this->project->tasks = $this->project->tasks->sortByDesc('name');
        }elseif($this->sort == 'newest'){
            $this->project->tasks = $this->project->tasks->sortByDesc('created_at');
        }elseif($this->sort == 'oldest'){
            $this->project->tasks = $this->project->tasks->sortBy('created_at');
        }

        if($this->byUser != 'all'){
            $this->project->tasks = $this->project->tasks->filter(function($task){
                return $task->users->contains('id',$this->byUser);
            });
        }

        if($this->byTeam != 'all'){
            $this->project->tasks = $this->project->tasks->filter(function($task){
                return $task->teams->contains('id',$this->byTeam);
            });
        }

        $this->users = User::all();
    }

    public function updatedByUser($value){
        $this->byUser = $value;
        return $this->redirect(route('project.profile',['id'=>$this->project->id,'sort'=>$this->sort,'filter'=>$this->filter,'byUser'=>$this->byUser,'byTeam'=>$this->byTeam]), navigate: true);
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

    public function emitEditTaskEvent($id){
        $this->dispatch('editTask', $id);
    }

    public function emitEditProjectEvent($id){
        $this->dispatch('editProject',$id);
    }

    public function emitDeleteProjectEvent($id){
        $this->dispatch('deleteProject',$id);
    }

    public function deleteTask($id){
        $task = Task::find($id);
        $task->delete();
        $this->dispatch('task-deleted','Task deleted successfully');
    }
}
 