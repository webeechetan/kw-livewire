<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
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
 


    public $users;
    public $projects;
    public $teams;
    public $project_id;
    public $user_ids;

    public $view_form = false;
    public $edit_task = false;

    // edit task 

    public $task;

    // comment

    public $comment;
    public $comments;

    public function render()
    {

        $this->allTasks = Task::count();
        $this->activeTasks = Task::where('status', 'active')->count();
        $this->completedTasks = Task::where('status', 'completed')->count();
        $this->archivedTasks = Task::onlyTrashed()->count();
      

        $tasks = Task::where('name','like','%'.$this->query.'%');
        
         
        //  if($this->sort == 'a_z'){
        //     $tasks->orderBy('name');
        // }elseif($this->sort == 'z_a'){
        //     $tasks->orderByDesc('name');
        // }elseif($this->sort == 'newest'){
            
        //     $tasks->latest();
        // }

        // if($this->byProject != 'all'){
        //     // select from project_user
        //     $tasks->whereHas('tasks',function($query){
        //         $query->where('project_id',$this->byProject);
        //     });
        // }


        $tasks->orderBy('id','desc');

        $tasks = $tasks->paginate(15);

        return view('livewire.tasks.list-task',[
            'tasks' => $tasks
        ]);

       // return view('livewire.tasks.list-task');
    }

    public function mount()
    {
        $this->auth_user_id = auth()->guard(session('guard'))->user()->id;
        $this->users = User::all();
        $this->projects = Project::all();
        $this->teams = Team::all();
        // Fetch all tasks from the database

        $this->tasks = [
            'pending' => Task::tasksByUserType()->where('status','pending')->orderBy('task_order')->get(),
            'in_progress' => Task::tasksByUserType()->where('status','in_progress')->orderBy('task_order')->get(),
            'in_review' => Task::tasksByUserType()->where('status','in_review')->orderBy('task_order')->get(),
            'completed' => Task::tasksByUserType()->where('status','completed')->orderBy('task_order')->get(),
        ];
    }


    public function updateTaskOrder($list)
    {
        // dd($list);
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
        $this->resetPage();
    }

    


}
