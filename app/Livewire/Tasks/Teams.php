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


class Teams extends Component
{
    use WithPagination;

    public $allTasks;
    public $pendingTasks;
    public $inProgressTasks;
    public $inReviewTasks;
    public $completedTasks;
    public $overdueTasks;

    // auth 

    public $auth_user_id;

    public $tasks;
    public $tasks_count = [];

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
    public $byTeam = 'all';
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


    public function render()
    {
        return view('livewire.tasks.teams');
    }

      
    public function mount()
    {

            $this->allTasks = Task::tasksByUserType($this->assignedByMe)->count();
            $this->pendingTasks = Task::tasksByUserType($this->assignedByMe)->where('status', 'pending')->count();
            $this->inProgressTasks = Task::tasksByUserType($this->assignedByMe)->where('status', 'in_progress')->count();
            $this->inReviewTasks = Task::tasksByUserType($this->assignedByMe)->where('status', 'in_review')->count();
            $this->completedTasks = Task::tasksByUserType($this->assignedByMe)->where('status', 'completed')->count();
            $this->overdueTasks = Task::tasksByUserType($this->assignedByMe)->where('due_date', '<', now())->where('status', '!=', 'completed')->count();
            // dd($this->overdueTasks);
            $this->doesAnyFilterApplied();
            $this->authorize('View Task');
            $this->tasks_count = Task::all();
            if(!($this->currentRoute)){
                $this->currentRoute = request()->route()->getName();
            }
           
            $this->auth_user_id = auth()->guard(session('guard'))->user()->id;
            if($this->byClient != 'all'){
                $this->projects = Project::where('client_id', $this->byClient)->get();
            }else{
                $this->projects = Project::all();
            }

            if($this->byProject != 'all'){
                $this->users = Project::find($this->byProject)->members;
            }else{
                $this->users = User::all();
            }

            $this->teams = Team::all();
            $this->clients = Client::all();
           
            $this->tasks = [
                'pending' => $this->applySort(
                    Task::where('status', 'pending')
                        ->where('name', 'like', '%' . $this->query . '%')
                )->get(),
    
                'in_progress' => $this->applySort(
                                    Task::where('status', 'in_progress')
                                        ->where('name', 'like', '%' . $this->query . '%')
                                )->get(),
                
                'in_review' => $this->applySort(
                                Task::where('status', 'in_review')
                                    ->where('name', 'like', '%' . $this->query . '%')
                            )->get(),

                'completed' => $this->applySort(
                                Task::where('status', 'completed')
                                ->where('name', 'like', '%' . $this->query . '%')
                            )->get(),
                
            ];


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

    public function updatedByTeam($value)
    {
        $this->mount();
        $this->projects = Team::find($this->byTeam)->projects;
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
            $this->status,
            $this->byTeam
        );
    }

    public function doesAnyFilterApplied(){

        // dd($this->sort);

        if($this->sort != 'all' || $this->byProject != 'all' || $this->byClient != 'all' || $this->byUser != 'all' || $this->startDate || $this->dueDate || $this->status != 'all'){
            return true;
        }
        return false;
    }

}
