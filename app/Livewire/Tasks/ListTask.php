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

class ListTask extends Component
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
    public $dueDate;
    public $mentioned_users= [];

    
    public $query = '';
    public $sort = 'all';
    public $filter = 'all';
    public $byProject = 'all';
    public $byClient = 'all';
    public $byUser = 'all';
    public $byTeam = 'all';
 


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

        $tasks = Task::where('name','like','%'.$this->query.'%');

        if($this->sort == 'a_z'){
            $tasks->orderBy('name');
        }elseif($this->sort == 'z_a'){
            $tasks->orderByDesc('name');
        }elseif($this->sort == 'newest'){
            $tasks->latest();
        }

        if($this->byClient != 'all'){
          
        }

        if($this->byProject != 'all'){
            $tasks->whereHas('tasks', function($query){
                $query->where('project_id', $this->byProject);
            });   
        }

        if($this->byUser != 'all'){
            $user = User::find($this->byUser);
            if($user){
                $tasksIds = $user->tasks->pluck('id')->toArray();
                $tasks->whereIn('id',$tasksIds);
            }
        }

        if($this->byTeam != 'all'){
            $team = Team::find($this->byTeam);
            if($team){
                $tasksIds = $team->tasks->pluck('id')->toArray();
                $tasks->whereIn('id',$tasksIds);
            }
        }

       
       
        $tasks->orderBy('id','desc');

        $tasks = $tasks->paginate(12);

       
        return view('livewire.tasks.list-task',[
            'tasks' => $tasks
        ]);

       // return view('livewire.tasks.list-task');
    }

    public function mount()
    {

            $this->authorize('View Task');
            
            $this->auth_user_id = auth()->guard(session('guard'))->user()->id;
            $this->users = User::all();
            $this->projects = Project::all();
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
            'pending' => Task::tasksByUserType()->where('status','pending')->orderBy('task_order')->get(),
            'in_progress' => Task::tasksByUserType()->where('status','in_progress')->orderBy('task_order')->get(),
            'in_review' => Task::tasksByUserType()->where('status','in_review')->orderBy('task_order')->get(),
            'completed' => Task::tasksByUserType()->where('status','completed')->orderBy('task_order')->get(),
        ];
    }

    public function emitEditTaskEvent($id){
        $this->dispatch('editTask', $id);
    }

    public function search()
    {
        $this->mount();
    }

    protected function applySort($query)
    {
        switch ($this->sort) {
            case 'a_z':
                return $query->orderBy('name');
            case 'z_a':
                return $query->orderByDesc('name');
            case 'newest':
                return $query->latest();
            case 'oldest':
                return $query->oldest();
            default:
                return $query->orderBy('task_order');
        }
    }
}
