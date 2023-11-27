<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;

class ListTask extends Component
{
    public $tasks;

    public $view_form = false;

    public function render()
    {
        return view('livewire.tasks.list-task');
    }

    public function mount()
    {
        // Fetch all tasks from the database
        $this->tasks = [
            'pending' => Task::where('status', 'pending')->get(),
            'in_progress' => Task::where('status', 'in_progress')->get(),
            'in_review' => Task::where('status', 'in_review')->get(),
            'completed' => Task::where('status', 'completed')->get(),
        ];
    }

    public function addTask()
    {

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
            if($item['value'] == 'group-pending'){
                foreach($item['items'] as $task){
                    $task = Task::find($task['value']);
                    $task->status = 'pending';
                    $task->save();
                }
            }
            if($item['value'] == 'group-in-progress'){
                foreach($item['items'] as $task){
                    $task = Task::find($task['value']);
                    $task->status = 'in_progress';
                    $task->save();
                }
            }

            if($item['value'] == 'group-in-review'){
                foreach($item['items'] as $task){
                    $task = Task::find($task['value']);
                    $task->status = 'in_review';
                    $task->save();
                }
            }

            if($item['value'] == 'group-completed'){
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
        $task->team_id = $this->team_id;
        $task->name = $this->name;
        $task->description = $this->description;
        $task->due_date = $this->dueDate;
        $task->status = 'pending';
        $task->save();

        $task->users()->attach($this->user_ids);
        session()->flash('message','Task created successfully');
        $this->redirect(route('task.index'),navigate:true);
    }
}
