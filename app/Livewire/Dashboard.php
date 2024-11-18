<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Pin;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{

    public $mostImportantProjects = [];
    public $users_tasks = [];
    public $active_projects = [];
    public $recent_comments = [];
    public $myPins = [];

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function mount(){
        $this->mostImportantProjects = $this->getMostImportantProjects();
        $this->users_tasks = Task::tasksByUserType()->get();
        $this->active_projects = Auth::user()->projects->where('status','!=','completed')->count();
        $tour = session()->get('tour');
        if(request()->tour == 'close-main-tour'){
            // $tour['main_tour'] = false;
            unset($tour['main_tour']);
            session()->put('tour',$tour);
        }
        $this->getRecentComments();
        $this->myPins = Pin::where('user_id',Auth::id())->get(); 
    }

    // nearest due date and more pending tasks are most important projects

    public function getMostImportantProjects(){
        if(Auth::user()->hasRole('Admin')){
            $projects = Project::where('status','!=','completed')->orderBy('due_date','asc')->limit(10)->get();
        }else{
            $projects = Auth::user()->projects->where('status','!=','completed')->sortBy('due_date')->take(10);
        }
        
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
        $task_ids = [];
        $task_ids = $this->users_tasks->pluck('id')->toArray();
        $this->recent_comments = Comment::whereIn('task_id',$task_ids)->orderBy('created_at','desc')->limit(5)->get();
    }

}
