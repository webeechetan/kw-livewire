<div class="container">
    <div class="row">
        <div class="col text-end">
            <div class="pull-right">
                <button class="btn btn-primary" wire:click="addTask">Add Task</button>
            </div>
        </div>
    </div>
    <div class="tab-view mt-4">
        <div class="tab-pane" id="board" role="tabpanel" aria-labelledby="board-tab">
            <div class="row flex-row flex-nowrap scrolling-wrapper mt-4">
                <div class="column" id="todo-column" wire:sortable="updateTaskOrder" wire:sortable-group="tasks.todo">
                    <h5>To Do</h5>
                    @foreach($tasks['todo'] as $task)
                        <div class="task" draggable="true" wire:sortable.item="{{ $task['id'] }}" data-status="todo">
                            {{ $task['name'] }}
                        </div>
                    @endforeach
                </div>
                <div class="column" id="inprogress-column" wire:sortable="updateTaskOrder" wire:sortable-group="tasks.inprogress">
                    <h5>In Progress</h5>
                    @foreach($tasks['inprogress'] as $task)
                        <div class="task" draggable="true" wire:sortable.item="{{ $task['id'] }}" data-status="inprogress">
                            {{ $task['name'] }}
                        </div>
                    @endforeach
                </div>
                <div class="column" id="done-column" wire:sortable="updateTaskOrder" wire:sortable-group="tasks.done">
                    <h5>Done</h5>
                    @foreach($tasks['done'] as $task)
                        <div class="task" draggable="true" wire:sortable.item="{{ $task['id'] }}" data-status="done">
                            {{ $task['name'] }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
