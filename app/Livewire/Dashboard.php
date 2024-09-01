<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\Task;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{

    public $mostImportantProjects = [];
    public $users_tasks = [];
    public $active_projects = [];
    public $recent_comments = [];

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function mount(){
        $this->getRecentComments();
        $this->mostImportantProjects = $this->getMostImportantProjects();
        $this->users_tasks = Task::tasksByUserType()->get();
        $this->active_projects = Auth::user()->projects->where('status','!=','completed')->count();
        $tour = session()->get('tour');
        if(request()->tour == 'close-main-tour'){
            // $tour['main_tour'] = false;
            unset($tour['main_tour']);
            session()->put('tour',$tour);
        }
    }

    // nearest due date and more pending tasks are most important projects

    public function getMostImportantProjects(){
        $projects = Project::where('status','!=','completed')->orderBy('due_date','asc')->limit(10)->get();
        
        $mostImportantProjects = [];

        foreach($projects as $project){
            $project->pending_tasks = $project->tasks()->where('status','!=','completed')->count();
            $mostImportantProjects[] = $project;
        }

        $mostImportantProjects = collect($mostImportantProjects)->sortByDesc('pending_tasks')->take(2);

        return $mostImportantProjects;
       
    }

    public function getRecentComments(){
        // get 5 recent comments of the user tasks

       

    }

}
