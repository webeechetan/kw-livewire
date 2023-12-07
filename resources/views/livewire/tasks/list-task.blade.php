<div class="container">
    <div class="main-body-header">
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
                    <div class="d-flex gap-2 justify-content-end">
                        <a class="btn-border btn-border-primary" wire:navigate href="{{ route('task.add') }}"><i class='bx bx-plus' ></i> Add Task</a>
                        <a class="btn-border" href="#"><i class='bx bx-filter' ></i> Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kanban -->
    <div class="kanban_bord">
        <div class="kanban_bord_scrollbar">
            <div class="kanban_bord_body_columns" wire:sortable-group="updateTaskOrder">
                <div class="kanban_bord_column kanban_bord_column_assigned" wire:key="group-pending">
                    <div class="kanban_bord_column_title_wrap">
                        <div class="kanban_bord_column_title">Assigned</div>
                    </div>
                    <div class="kanban_column" id="pending-column" wire:sortable-group.item-group="group-pending" wire:sortable-group.options="{ animation: 100 }">
                        <div class="alert alert-success text-center">
                            <i class="bx bx-plus"></i>
                        </div>
                        @foreach($tasks['pending'] as $task)
                        <div class="kanban_column_task kanban_column_task_overdue h-100" wire:key="pending-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>{{ $task['name'] }}</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>{{ $task['due_date'] }}</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            @foreach($task['users'] as $user)
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" />
                                                </span>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="kanban_bord_column kanban_bord_column_accepted" wire:key="group-in-progress">
                    <div class="kanban_bord_column_title_wrap">
                        <div class="kanban_bord_column_title text-yellow-dark">Accepted</div>
                    </div>
                    <div class="kanban_column" wire:sortable-group.item-group="group-in-progress" wire:sortable-group.options="{ animation: 100 }">
                        @foreach($tasks['in_progress'] as $task)
                        <div class="kanban_column_task kanban_column_task_warning h-100" wire:key="in-progress-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>{{ $task['name'] }}</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>{{ $task['due_date'] }}</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            @foreach($task['users'] as $user)
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" title="{{ $user->name }}">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" />
                                                </span>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="kanban_bord_column kanban_bord_column_in_review" id="in-review-column" wire:key="group-in-review">
                    <div class="kanban_bord_column_title_wrap">
                        <div class="kanban_bord_column_title text-secondary">In Review</div>
                    </div>
                    <div class="kanban_column" wire:sortable-group.item-group="group-in-review" wire:sortable-group.options="{ animation: 100 }">
                        @foreach($tasks['in_review'] as $task)
                        <div class="kanban_column_task kanban_column_task_overdue h-100" wire:key="in-review-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>{{ $task['name'] }}</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>{{ $task['due_date'] }}</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            @foreach($task['users'] as $user)
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" title="{{ $user->name }}">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" />
                                                </span>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="kanban_bord_column kanban_bord_column_completed" id="completed-cloumn" wire:key="group-completed">
                    <div class="kanban_bord_column_title_wrap">
                        <div class="kanban_bord_column_title text-success">Completed</div>
                    </div>
                    <div class="kanban_column" wire:sortable-group.item-group="group-completed" wire:sortable-group.options="{ animation: 100 , dragClass : 'task-dragging' }">
                        @foreach($tasks['completed'] as $task)
                        <div class="kanban_column_task kanban_column_task_done h-100" wire:key="completed-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}" data-task="{{$task['id']}}">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>{{ $task['name'] }}</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>{{ $task['due_date'] }}</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            @foreach($task['users'] as $user)
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" title="{{ $user->name }}">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" />
                                                </span>
                                            </a>
                                            @endforeach
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
    <script>
    </script>
@endpush
