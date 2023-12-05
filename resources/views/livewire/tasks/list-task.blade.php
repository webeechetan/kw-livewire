<div class="container">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="main-body-header-title mb-0">All Tasks</h3>
            <div class="tabNavigationBar-tab">
                <a class="tabNavigationBar-item" href="/task-list"><i class='bx bx-list-ul' ></i> List</a>
                <a class="tabNavigationBar-item tabNavigationBar-item-active" href="#"><i class='bx bx-columns' ></i> Board</a>
            </div>
        </div>
        <div class="text-end col">
            <div class="main-body-header-right">
                <div class="main-body-header-btn_group justify-content-end">
                    <a class="main-body-header-btnAdd" wire:navigate href="{{ route('task.add') }}"><i class='bx bx-plus' ></i> Add Task</a>
                    <div class="main-body-header-btnAdd"><i class='bx bx-filter' ></i> Filter</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kanban -->
    <div class="kanban_bord">
        <div class="kanban_bord_body">
            <div class="kanban_bord_scrollbar">
                <div class="kanban_bord_body_columns" wire:sortable-group="updateTaskOrder">
                    <div id="pending-column" class="kanban_bord_column kanban_bord_column_assigned" wire:key="group-pending">
                        <div class="kanban_bord_column_title_wrap">
                            <div class="kanban_bord_column_title">Assigned</div>
                        </div>
                        <div class="kanban_column_card_body">
                            <div class="kanban_column_card">
                                <div wire:sortable-group.item-group="group-pending" wire:sortable-group.options="{ animation: 100 }">
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
                        </div>
                    </div>
                    <div id="in-progress-column" class="kanban_bord_column kanban_bord_column_accepted" wire:key="group-in-progress">
                        <div class="kanban_bord_column_title_wrap">
                            <div class="kanban_bord_column_title">Accepted</div>
                        </div>
                        <div class="kanban_column_card_body">
                            <div class="kanban_column_card">
                                <div wire:sortable-group.item-group="group-in-progress" wire:sortable-group.options="{ animation: 100 }">
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
                        </div>
                    </div>
                    <div id="in-review-column" class="kanban_bord_column kanban_bord_column_in_review" wire:key="group-in-review">
                        <div class="kanban_bord_column_title_wrap">
                            <div class="kanban_bord_column_title">In Review</div>
                        </div>
                        <div class="kanban_column_card_body">
                            <div class="kanban_column_card">
                                <div wire:sortable-group.item-group="group-in-review" wire:sortable-group.options="{ animation: 100 }">
                                    @foreach($tasks['in_review'] as $task)
                                        <div class="task" wire:key="in-review-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}">
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
                        </div>
                    </div>
                    <div id="completed-cloumn" class="kanban_bord_column kanban_bord_column_completed" wire:key="group-completed">
                        <div class="kanban_bord_column_title_wrap">
                            <div class="kanban_bord_column_title">Completed</div>
                        </div>
                        <div class="kanban_column_card_body">
                            <div class="kanban_column_card">
                                <div wire:sortable-group.item-group="group-completed" wire:sortable-group.options="{ animation: 100 , dragClass : 'task-dragging' }">
                                    @foreach($tasks['completed'] as $task)
                                        <div class="task text-center" wire:key="completed-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}" data-task="{{$task['id']}}">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if($view_form)
        <livewire:tasks.add-task />
    @endif

    

</div>

@push('scripts')
    <script>
    </script>
@endpush
