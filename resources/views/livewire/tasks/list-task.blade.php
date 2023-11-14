<!-- resources/views/livewire/tasks/list-task.blade.php -->

<div class="container" wire:poll>
    <div class="row">
        <div class="col text-end">
            <div class="pull-right">
                <a wire:navigate href="{{ route('task.add') }}"><button class="btn btn-primary">Add Task</button></a>
            </div>
        </div>
    </div>
    <div class="tab-view mt-4">
        <div class="tab-pane" id="board" role="tabpanel" aria-labelledby="board-tab">
            <div class="row flex-row flex-nowrap scrolling-wrapper mt-4" wire:sortable-group="updateTaskOrder">
                <div class="column" id="pending-column" wire:key="group-pending">
                    <div wire:sortable-group.item-group="group-pending" wire:sortable-group.options="{ animation: 100 }">
                        <h5>Pending</h5>
                        @foreach($tasks['pending'] as $task)
                            <div class="task text-center" wire:key="pending-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>{{ $task['name'] }}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <b>{{ $task['due_date'] }}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>{!! $task['description'] !!}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Assign To</p>
                                                @foreach($task->users as $user)
                                                    <span class="btn btn-primary btn-sm mt-1">{{ $user->name }}</span> <br>
                                                @endforeach
                                            </div>
                                            <div class="col-md-6 ml-2">
                                                <p>Assign To Team</p>
                                                @if($task->team)
                                                    <span class="btn btn-primary btn-sm">{{ $task->team->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="column" id="in-progress-column" wire:key="group-in-progress">
                    <div wire:sortable-group.item-group="group-in-progress" wire:sortable-group.options="{ animation: 100 }">
                        <h5>In Progress</h5>
                        @foreach($tasks['in_progress'] as $task)
                            <div class="task" wire:key="in-progress-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>{{ $task['name'] }}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <b>{{ $task['due_date'] }}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>{!! $task['description'] !!}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Assign To</p>
                                                @foreach($task->users as $user)
                                                    <span class="btn btn-primary btn-sm mt-1">{{ $user->name }}</span> <br>
                                                @endforeach
                                            </div>
                                            <div class="col-md-6 ml-2">
                                                <p>Assign To Team</p>
                                                @if($task->team)
                                                    <span class="btn btn-primary btn-sm">{{ $task->team->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="column" id="in-review-column" wire:key="group-in-review">
                    <div wire:sortable-group.item-group="group-in-review" wire:sortable-group.options="{ animation: 100 }">
                        <h5>In Review</h5>
                        @foreach($tasks['in_review'] as $task)
                            <div class="task" wire:key="in-review-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}">
                                <div class="card kanban_column_task_overdue">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>{{ $task['name'] }}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <b>{{ $task['due_date'] }}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>{!! $task['description'] !!}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Assign To</p>
                                                @foreach($task->users as $user)
                                                    <span class="btn btn-primary btn-sm mt-1">{{ $user->name }}</span> <br>
                                                @endforeach
                                            </div>
                                            <div class="col-md-6 ml-2">
                                                <p>Assign To Team</p>
                                                @if($task->team)
                                                    <span class="btn btn-primary btn-sm">{{ $task->team->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="column " id="completed-cloumn" wire:key="group-completed">
                    <div wire:sortable-group.item-group="group-completed" wire:sortable-group.options="{ animation: 100 , dragClass : 'task-dragging' }">
                        <h5>Completed</h5>
                        @foreach($tasks['completed'] as $task)
                            <div class="task text-center " wire:key="completed-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}" data-task="{{$task['id']}}">
                                <div class="card kanban_column_task_done">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>{{ $task['name'] }}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <b>{{ $task['due_date'] }}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>{!! $task['description'] !!}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Assign To</p>
                                                @foreach($task->users as $user)
                                                    <span class="btn btn-primary btn-sm mt-1">{{ $user->name }}</span> <br>
                                                @endforeach
                                            </div>
                                            <div class="col-md-6 ml-2">
                                                <p>Assign To Team</p>
                                                @if($task->team)
                                                    <span class="btn btn-primary btn-sm">{{ $task->team->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
