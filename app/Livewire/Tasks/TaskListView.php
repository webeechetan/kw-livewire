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


class TaskListView extends Component
{
    use WithPagination;

    public $allTasks;
    public $activeTasks;
    public $completedTasks;
    public $archivedTasks;

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


    public function render()
    {
        return view('livewire.tasks.task-list-view');
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
            // Fetch all tasks from the database
            if($this->ViewTasksAs == 'manager'){
                $manager_team = auth()->user()->myTeam;
                $team_users = $manager_team->users()->pluck('users.id')->toArray();
                $this->tasks = [
                    'pending' => $this->applySort(
                        Task::where('status', 'pending')
                            ->whereHas('users', function($q) use($team_users){
                                $q->whereIn('user_id', $team_users);
                            })
                            ->where('name', 'like', '%' . $this->query . '%')
                    )->get(),
                    'in_progress' => $this->applySort(
                        Task::where('status', 'in_progress')
                            ->whereHas('users', function($q) use($team_users){
                                $q->whereIn('user_id', $team_users);
                            })
                            ->where('name', 'like', '%' . $this->query . '%')
                    )->get(),
                    'in_review' => $this->applySort(
                        Task::where('status', 'in_review')
                            ->whereHas('users', function($q) use($team_users){
                                $q->whereIn('user_id', $team_users);
                            })
                            ->where('name', 'like', '%' . $this->query . '%')
                    )->get(),
                    'completed' => $this->applySort(
                        Task::where('status', 'completed')
                            ->whereHas('users', function($q) use($team_users){
                                $q->whereIn('user_id', $team_users);
                            })
                            ->where('name', 'like', '%' . $this->query . '%')
                    )->get(),
                ];
                // dd($this->tasks);

            }else{
                $this->tasks = [
                    'pending' => $this->applySort(
                        Task::tasksByUserType()
                            ->where('status', 'pending')
                            ->where('name', 'like', '%' . $this->query . '%')
                    )->get(),
        
                    'in_progress' => $this->applySort(
                                        Task::tasksByUserType()
                                            ->where('status', 'in_progress')
                                            ->where('name', 'like', '%' . $this->query . '%')
                                    )->get(),
                    
                    'in_review' => $this->applySort(
                                    Task::tasksByUserType()
                                        ->where('status', 'in_review')
                                        ->where('name', 'like', '%' . $this->query . '%')
                                )->get(),
    
                    'completed' => $this->applySort(
                                    Task::tasksByUserType()
                                    ->where('status', 'completed')
                                    ->where('name', 'like', '%' . $this->query . '%')
                                )->get(),
                    
                ];
            }


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
