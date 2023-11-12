<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;

class ListTask extends Component
{
    public $tasks;

    protected $listeners = [
        'task-updated' => '$refresh',
    ];

    public $state;

    public function render()
    {
        return view('livewire.tasks.list-task');
    }

    public function mount()
    {
        // Fetch all tasks from the database
        $this->tasks = [
            'pending' => Task::where('status', 'pending')->get()->toArray(),
            'in_progress' => Task::where('status', 'in_progress')->get()->toArray(),
            'completed' => Task::where('status', 'completed')->get()->toArray(),
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
            'pending' => Task::where('status', 'pending')->get()->toArray(),
            'in_progress' => Task::where('status', 'in_progress')->get()->toArray(),
            'completed' => Task::where('status', 'completed')->get()->toArray(),
        ];

        $this->dispatch('task-updated');
    }

    public function updatedState()
    {
        dd('state changed');
        $this->dispatch('task-updated');
    }
}
