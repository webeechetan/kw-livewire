<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\Team;
use App\Models\Comment;
use App\Notifications\NewTaskAssignNotification;
use App\Notifications\UserMentionNotification;
use Livewire\WithPagination;
use App\Helpers\Helper;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use App\Helpers\Filter;
use Livewire\Attributes\Session;

class ListTask extends Component
{
    use WithPagination;

    protected $listeners = ['saved' => 'refresh'];

    public $allTasks;
    public $activeTasks;
    public $completedTasks;
    public $archivedTasks; 
    public $perPage = 15;
    public $userTotalTasks;
    public $managerTotalTasks;
    public $totalTasks;

    // auth 

    public $auth_user_id;

    public $tasks;

    // Add task Form
    public $name;
    public $description;
    public $mentioned_users= [];
    
    
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

    public $currentRoute;

    public $ViewTasksAs = 'user';
    public $assignedByMe = false;

    public function render()
    {  
        return view('livewire.tasks.list-task');
    }

    public function loadMore(){

        $this->perPage += 5;
        $this->mount();
    }

    public function updatedAssignedByMe($value)
    {
        $this->mount();
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

            // dd($this->projects);
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
                    )->take($this->perPage)->get(),
                    'in_progress' => $this->applySort(
                        Task::where('status', 'in_progress')
                            ->whereHas('users', function($q) use($team_users){
                                $q->whereIn('user_id', $team_users);
                            }) 
                            ->where('name', 'like', '%' . $this->query . '%')
                    )->take($this->perPage)->get(),
                    'in_review' => $this->applySort(
                        Task::where('status', 'in_review')
                            ->whereHas('users', function($q) use($team_users){
                                $q->whereIn('user_id', $team_users);
                            })
                            ->where('name', 'like', '%' . $this->query . '%')
                    )->take($this->perPage)->get(),
                    'completed' => $this->applySort(
                        Task::where('status', 'completed')
                            ->whereHas('users', function($q) use($team_users){
                                $q->whereIn('user_id', $team_users);
                            })
                            ->where('name', 'like', '%' . $this->query . '%')
                    )->take($this->perPage)->get(),
                ];
                // dd($this->tasks);
                $this->totalTasks = Task::whereHas('users', function($q) use($team_users){
                    $q->whereIn('user_id', $team_users);
                })->count();
            }else{
                $this->tasks = [
                    'pending' => $this->applySort(
                        Task::tasksByUserType($this->assignedByMe)
                            ->where('status', 'pending') 
                            ->where('name', 'like', '%' . $this->query . '%')
                        )->take($this->perPage)->get(),
        
                    'in_progress' => $this->applySort(
                        Task::tasksByUserType($this->assignedByMe)
                            ->where('status', 'in_progress')
                            ->where('name', 'like', '%' . $this->query . '%')
                        )->take($this->perPage)->get(),

                    
                    'in_review' => $this->applySort(
                        Task::tasksByUserType($this->assignedByMe)
                            ->where('status', 'in_review')
                            ->where('name', 'like', '%' . $this->query . '%')
                        )->take($this->perPage)->get(),

    
                    'completed' => $this->applySort(
                        Task::tasksByUserType($this->assignedByMe)
                            ->where('status', 'completed')
                            ->where('name', 'like', '%' . $this->query . '%')
                        )->take($this->perPage)->get(),

                ];
                if($this->doesAnyFilterApplied()){
                    $this->totalTasks = $this->applySort(
                        Task::tasksByUserType($this->assignedByMe)
                            ->where('name', 'like', '%' . $this->query . '%')
                    )->count();
                }else{
                    $this->totalTasks = Task::tasksByUserType($this->assignedByMe)->count();
                }
            }

            

            $tour = session()->get('tour');
            if(request()->tour == 'close-task-tour'){
                // $tour['task_tour'] = false;
                unset($tour['task_tour']);
                session()->put('tour',$tour);
            }
            


    }

    public function refresh()
    {
        $this->mount();
    }

    public function updatedSort($value)
    {
        // dd($value);
        $this->mount();
    }

    public function updatedViewTasksAs($value)
    {
        $this->mount();
    }


    public function updateTaskOrder($list)
    {

        foreach ($list as $item) {
            if($item['value'] == 'pending'){
                foreach($item['items'] as $t){
                    $task = Task::find($t['value']);
                    $task->status = 'pending';
                    $task->task_order = $t['order'];
                    $task->save();
                }
            }
            if($item['value'] == 'in_progress'){
                foreach($item['items'] as $t){
                    $task = Task::find($t['value']);
                    $task->status = 'in_progress';
                    $task->task_order = $t['order'];
                    $task->save();
                }
            }

            if($item['value'] == 'in_review'){
                foreach($item['items'] as $t){
                    $task = Task::find($t['value']);
                    $task->status = 'in_review';
                    $task->task_order = $t['order'];
                    $task->save();
                }
            }

            if($item['value'] == 'completed'){
                foreach($item['items'] as $t){
                    $task = Task::find($t['value']);
                    $task->status = 'completed';
                    $task->task_order = $t['order'];
                    $task->save();
                }
            }
        }

        $this->tasks = [
            'pending' => $this->applySort(Task::tasksByUserType($this->assignedByMe)->where('status','pending')->orderBy('task_order'))->limit($this->perPage)->get(),
            'in_progress' => $this->applySort(Task::tasksByUserType($this->assignedByMe)->where('status','in_progress')->orderBy('task_order'))->limit($this->perPage)->get(),
            'in_review' => $this->applySort(Task::tasksByUserType($this->assignedByMe)->where('status','in_review')->orderBy('task_order'))->limit($this->perPage)->get(),
            'completed' => $this->applySort(Task::tasksByUserType($this->assignedByMe)->where('status','completed')->orderBy('task_order'))->limit($this->perPage)->get(),
        ];
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
        $this->projects = Project::where('client_id', $value)->get();
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
