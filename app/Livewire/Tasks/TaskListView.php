<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Team;
use App\Models\Comment;
use App\Notifications\NewTaskAssignNotification;


class TaskListView extends Component
{
    public $tasks;

    // add task 
    public $view_form = false;

    // edit task 
    public $edit_task = false;
    public $task;
    public $name;
    public $description;
    public $dueDate;
    
    public $users;
    public $projects;
    public $teams;
    public $project_id;
    public $user_ids;
    public $comment;
    public $comments;

    public function render()
    {
        return view('livewire.tasks.task-list-view');
    }

    public function mount()
    {
        $this->users = User::all();
        $this->projects = Project::all();
        $this->teams = Team::all();
        // Fetch all tasks from the database
        $this->tasks = [
            'pending' => Task::where('status', 'pending')->orderBy('task_order')->get(),
            'in_progress' => Task::where('status', 'in_progress')->orderBy('task_order')->get(),
            'in_review' => Task::where('status', 'in_review')->orderBy('task_order')->get(),
            'completed' => Task::where('status', 'completed')->orderBy('task_order')->get(),
        ];
    }

    public function toggleForm()
    {
        $this->view_form = !$this->view_form;
        $this->dispatch('task-form-toggled');
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
        $this->redirect(route('task.list-view'),navigate:true);
    }

    public function enableEditForm($id){
        $this->edit_task = true;
        $this->task = Task::with('comments')->where('id',$id)->first();
        $this->comments = $this->task->comments;
        $this->project_id = $this->task->project_id;
        $this->user_ids = $this->task->users->pluck('id')->toArray();
        $this->name = $this->task->name;
        $this->description = $this->task->description;
        $this->dueDate = $this->task->due_date;
        $this->dispatch('edit-task-showed');
    }

    public function updateTask(){
        $this->validate([
            'name' => 'required'
        ]);

        $this->task->project_id = $this->project_id;
        $this->task->name = $this->name;
        $this->task->description = $this->description;
        $this->task->due_date = $this->dueDate;
        $this->task->save();

        $this->task->users()->sync($this->user_ids);
        session()->flash('message','Task updated successfully');
        $this->redirect(route('task.list-view'),navigate:true);
    }

    public function saveComment(){
        $this->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->task_id = $this->task->id;
        $comment->user_id = auth()->guard(session('guard'))->user()->id;
        $comment->comment = $this->comment;
        $comment->save();
        $this->comments = $this->task->comments;
        $this->dispatch('comment-added');

    }
}
