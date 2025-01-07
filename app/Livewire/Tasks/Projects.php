<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Team;
use App\Models\Comment;
use App\Models\Client;
use App\Notifications\NewTaskAssignNotification;
use App\Notifications\UserMentionNotification;
use Livewire\WithPagination;
use App\Helpers\Filter;


class Projects extends Component
{
    use WithPagination;
    // auth 

    public $auth_user_id;

    public $tasks;

    // Add task Form
    public $name;
    public $description;
    public $mentioned_users= [];
    public $currentRoute;
    
    public $query = '';
    public $sort = 'all';
    public $filter = 'all';
    public $byProject = 'all';
    public $byClient = 'all';
    public $byUser = 'all';
    // public $byTeam = 'all';
    public $startDate;
    public $dueDate; 
    public $status = 'all';
 


    public $teams = [];
    public $users = [];
    public $clients = [];
    public $projects;
    // public $teams;
    public $project_id; 
    public $user_ids;

    public $view_form = false;
    public $edit_task = false;

    // edit task 

    public $task;
 
    // comment

    public $comment;
    public $comments;

    public $ViewTasksAs = 'user';
    public $assignedByMe = false;

    public $totalTasks = 0;
    public $rows = 25;


    public function render()
    {
        return view('livewire.tasks.projects');
    }

      
    public function mount()
    {
 
            $this->doesAnyFilterApplied();
            $this->authorize('View Task');
            if(!($this->currentRoute)){
                $this->currentRoute = request()->route()->getName();
            }
           
            $this->auth_user_id = auth()->guard(session('guard'))->user()->id;
            if($this->byClient != 'all'){
                $this->projects = Project::where('client_id', $this->byClient)->orderBy('name', 'asc')->get();
            }else{
                $this->projects = Project::orderBy('name', 'asc')->get();
            }

            if($this->byProject != 'all'){
                $this->users = Project::find($this->byProject)->members;
            }else{
                $this->users = User::orderBy('name', 'asc')->get();
            }

            $this->teams = Team::orderBy('name', 'asc')->get();
            $this->clients = Client::orderBy('name', 'asc')->get();
            $this->tasks =  $this->applySort(
                    Task::where('name', 'like', '%' . $this->query . '%')
                        ->orderBy('created_at', 'desc')
                )->limit($this->rows)->get();

            $this->totalTasks =  $this->applySort(
                Task::where('name', 'like', '%' . $this->query . '%')
                    ->orderBy('created_at', 'desc')
            )->count();

    }

    public function loadMore()
    {
        $this->rows += 25;
        $this->tasks =  $this->applySort(
            Task::where('name', 'like', '%' . $this->query . '%')
                ->orderBy('created_at', 'desc')
        )->limit($this->rows)->get();
    }

    public function updatedAssignedByMe($value)
    {
        $this->mount();
    }

    public function updatedSort($value)
    {
        $this->mount();
    }

    public function updatedViewTasksAs($value)
    {
        $this->mount();
    }

    public function emitEditTaskEvent($id){
        $this->dispatch('editTask', $id);
    }

    public function search()
    {
        $this->mount();
    }


    public function updatedByClient($value)
    {
        $this->mount();
    }

    public function updatedByProject($value)
    {
        $this->mount();
    }

    public function updatedStartDate($value)
    {
        $this->mount();
    }

    public function updatedDueDate($value)
    {
        $this->mount();
    }

    public function updatedByUser($value)
    {
        $this->mount();
    }

    public function updatedStatus($value)
    {
        $this->mount();
    }

    public function applySort($query)
    {
    
        return Filter::filterTasks(
            $query, 
            $this->byProject, 
            $this->byClient, 
            $this->byUser, 
            $this->sort, 
            $this->startDate, 
            $this->dueDate, 
            $this->status
        );
    }

    public function doesAnyFilterApplied(){

        if($this->sort != 'all' || $this->byProject != 'all' || $this->byClient != 'all' || $this->byUser != 'all' || $this->startDate || $this->dueDate || $this->status != 'all'){
            return true;
        }
        return false;
    }

}
