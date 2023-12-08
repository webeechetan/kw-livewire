<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Team;
use App\Notifications\NewTaskAssignNotification;

class ListTask extends Component
{
    public $tasks;

    // Add task Form
    public $name;
    public $description;
    public $dueDate;

    public $users;
    public $projects;
    public $teams;
    public $project_id;
    public $user_ids;

    public $view_form = false;
    public $edit_task = false;

    // edit task 

    public $task;

    public function render()
    {
        return view('livewire.tasks.list-task');
    }

    public function mount()
    {
        $this->users = User::all();
        $this->projects = Project::all();
        $this->teams = Team::all();
        // Fetch all tasks from the database
        $this->tasks = [
            'pending' => Task::where('status', 'pending')->get(),
            'in_progress' => Task::where('status', 'in_progress')->get(),
            'in_review' => Task::where('status', 'in_review')->get(),
            'completed' => Task::where('status', 'completed')->get(),
        ];
    }

    public function toggleForm()
    {
        $this->view_form = !$this->view_form;
        $this->dispatch('task-form-toggled');
    }

    

    public function updateTaskStatus($task_id, $status)
    {
        $task = Task::find($task_id);
        $task->status = $status;
        $task->save();

        $this->tasks = [
            'pending' => Task::where('status', 'pending')->get(),
            'in_progress' => Task::where('status', 'in_progress')->get(),
            'in_review' => Task::where('status', 'in_review')->get(),
            'completed' => Task::where('status', 'completed')->get(),
        ];

    }

    public function updateTaskOrder($list)
    {
        foreach ($list as $item) {
            if($item['value'] == 'pending'){
                foreach($item['items'] as $task){
                    $task = Task::find($task['value']);
                    $task->status = 'pending';
                    $task->save();
                }
            }
            if($item['value'] == 'in_progress'){
                foreach($item['items'] as $task){
                    $task = Task::find($task['value']);
                    $task->status = 'in_progress';
                    $task->save();
                }
            }

            if($item['value'] == 'in_review'){
                foreach($item['items'] as $task){
                    $task = Task::find($task['value']);
                    $task->status = 'in_review';
                    $task->save();
                }
            }

            if($item['value'] == 'completed'){
                foreach($item['items'] as $task){
                    $task = Task::find($task['value']);
                    $task->status = 'completed';
                    $task->save();
                }
            }
        }

        $this->tasks = [
            'pending' => Task::where('status', 'pending')->get(),
            'in_progress' => Task::where('status', 'in_progress')->get(),
            'in_review' => Task::where('status', 'in_review')->get(),
            'completed' => Task::where('status', 'completed')->get(),
        ];
    }

    public function store(){
        $this->validate([
            'name' => 'required'
        ]);

        $task = new Task();
        $task->org_id = session('org_id');
        $task->assigned_by = auth()->guard(session('guard'))->user()->id;
        $task->project_id = $this->project_id;
        $task->name = $this->name;
        $task->description = $this->description;
        $task->due_date = $this->dueDate;
        $task->status = 'pending';
        // $task->when_completed_notify = $this->when_completed_notify;
        $task->save();

        $task->users()->attach($this->user_ids);
        foreach($this->user_ids as $user_id){
            $user = User::find($user_id);
            $user->notify(new NewTaskAssignNotification($task));
        }
        session()->flash('message','Task created successfully');
        $this->redirect(route('task.index'),navigate:true);
    }

    public function enableEditForm($id){
        $this->edit_task = true;
        $this->task = Task::find($id);
        $this->dispatch('edit-task-showed');
    }

    public function updateTask(){

    }
}
