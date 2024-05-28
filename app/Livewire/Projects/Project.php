<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project as ProjectModel;
use App\Models\User;
use App\Models\Task;
use App\Models\Team;

class Project extends Component
{

    public $project;
    public $users;

    public $projectTasks;
    public $projectUsers;
    public $projectTeams = [];

    public function render()
    {
        return view('livewire.projects.project');
    }

    public function mount($id){ 
        $this->project = ProjectModel::withTrashed()->with('client')->find($id);
        $this->users = User::all();
        $this->projectTasks =  Task::where('project_id',$id)->get();
        $this->projectUsers = $this->project->users;
        $tasks = Task::whereIn('project_id', [$this->project->id])->get();
        $task_users = []; 
        foreach ($tasks as $task) {
            $task_users = array_merge($task_users, $task->users->pluck('id')->toArray());
        }

        $this->projectTeams = Team::whereHas('users', function ($query) use ($task_users) {
            $query->whereIn('user_id', $task_users);
        })->get();

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
 