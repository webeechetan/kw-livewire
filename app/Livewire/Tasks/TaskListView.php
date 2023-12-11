<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;

class TaskListView extends Component
{
    public $tasks;

    public function render()
    {
        return view('livewire.tasks.task-list-view');
    }

    public function mount()
    {
        // Fetch all tasks from the database
        $this->tasks = [
            'pending' => Task::where('status', 'pending')->orderBy('task_order')->get(),
            'in_progress' => Task::where('status', 'in_progress')->orderBy('task_order')->get(),
            'in_review' => Task::where('status', 'in_review')->orderBy('task_order')->get(),
            'completed' => Task::where('status', 'completed')->orderBy('task_order')->get(),
        ];
    }
}
