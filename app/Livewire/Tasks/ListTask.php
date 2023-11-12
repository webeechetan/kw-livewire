<?php

namespace App\Livewire\Tasks;

use Livewire\Component;

class ListTask extends Component
{
    public $tasks = [
        'todo' => [],
        'inprogress' => [],
        'done' => [],
    ];

    public function render()
    {
        return view('livewire.tasks.list-task');
    }

    public function mount()
    {
        // Initialize tasks
        $this->tasks['todo'] = [['id' => 1, 'name' => 'Task 1'], ['id' => 2, 'name' => 'Task 2']];
        $this->tasks['inprogress'] = [['id' => 3, 'name' => 'Task 3']];
        $this->tasks['done'] = [['id' => 4, 'name' => 'Task 4']];
    }

    public function addTask()
    {
        // Add a new task to the 'todo' column
        $this->tasks['todo'][] = ['id' => count($this->tasks['todo']) + 1, 'name' => 'New Task'];
    }

    public function updateTaskOrder($list, $column)
    {
        // Update the task order when dragged and dropped
        $this->tasks[$column] = $list;
    }
}
