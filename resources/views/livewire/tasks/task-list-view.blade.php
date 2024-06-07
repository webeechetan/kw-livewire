<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('task.index') }}">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
    </nav>

    <!-- Dashboard Header -->
    <div class="dashboard-head pb-0 mb-4">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Tasks</h3>
                <span class="text-light">|</span>
                @can('Create Task')
                    <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" href="javascript:void(0);" class="btn-border btn-sm btn-border-primary toggleForm"><i class="bx bx-plus"></i> Add Task</a>
                @endcan
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Task">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                    <div class="main-body-header-filters">
                        <div class="cus_dropdown">
                            <div class="cus_dropdown-icon btn-border btn-border-secondary"><i class='bx bx-filter-alt' ></i> Filter</div>
                            <div class="cus_dropdown-body cus_dropdown-body-widh_l">
                                <div class="cus_dropdown-body-wrap">
                                    <div class="filterSort">
                                        <h5 class="filterSort-header"><i class='bx bx-sort-down text-primary' ></i> Sort By</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item">
                                                <a wire:click="$set('sort', 'newest')" class="btn-batch @if($sort == 'newest') active @endif ">Newest</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:click="$set('sort', 'oldest')" class="btn-batch @if($sort == 'oldest') active @endif " >Oldest</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:click="$set('sort', 'a_z')" class="btn-batch @if($sort == 'a_z') active @endif"><i class='bx bx-down-arrow-alt' ></i> A To Z</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:click="$set('sort', 'z_a')" class="btn-batch @if($sort == 'z_a') active @endif"><i class='bx bx-up-arrow-alt' ></i> Z To A</a>
                                            </li>
                                        </ul>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-calendar-alt text-primary' ></i> Filter By Date</h5>
                                        <div class="row align-items-center mt-2">
                                            <div class="col mb-4 mb-md-0" wire:ignore>
                                                <a href="javascript:;" class="btn w-100 btn-sm btn-border-secondary start_date">
                                                    @if($startDate)
                                                        {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}
                                                    @else
                                                        <i class='bx bx-calendar-alt' ></i> Start Date
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="col-auto text-center font-500 mb-4 mb-md-0 px-0">
                                                To
                                            </div>
                                            <div class="col" wire:ignore>
                                                <a href="javascript:;" class="btn w-100 btn-sm btn-border-danger due_date">
                                                    @if($dueDate)
                                                        {{ \Carbon\Carbon::parse($dueDate)->format('d M Y') }}
                                                    @else
                                                        <i class='bx bx-calendar-alt' ></i> Due Date
                                                    @endif
                                                </a>
                                            </div>
                                        </div> 
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-calendar-alt text-primary' ></i> Filter By Status</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a wire:click="$set('status', 'all')" class="btn-batch @if($status == 'all') active @endif">All</a></li>
                                            <li class="filterSort_item"><a wire:click="$set('status', 'pending')" class="btn-batch @if($status == 'pending') active @endif">Assigned</a></li>
                                            <li class="filterSort_item"><a wire:click="$set('status', 'in_progress')" class="btn-batch @if($status == 'in_progress') active @endif">Accepted</a></li>
                                            <li class="filterSort_item"><a wire:click="$set('status', 'in_review')" class="btn-batch @if($status == 'in_review') active @endif">In Review</a></li>
                                            <li class="filterSort_item"><a wire:click="$set('status', 'overdue')" class="btn-batch @if($status == 'overdue') active @endif">Overdue</a></li>
                                            <li class="filterSort_item"><a wire:click="$set('status', 'completed')" class="btn-batch @if($status == 'completed') active @endif">Completed</a></li>
                                        </ul>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                                        <select class="dashboard_filters-select w-100" wire:model.live="byClient" id="">
                                            <option value="all">Select Client</option>
                                            @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                        </select>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By Projects</h5>
                                        <select class="dashboard_filters-select w-100" wire:model.live="byProject" id="">
                                            <option value="all">All</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-user text-primary'></i> Filter By User</h5>
                                        <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byUser" id="">
                                            <option value="all">Select User</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <h5 class="filterSort-header mt-4"><i class='bx bx-user text-primary'></i> Filter By Team</h5>
                                        <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byTeam" id="">
                                            <option value="all">Select Team</option>
                                            @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-0">
        <div class="row align-items-center">
            <div class="col-md-6">
                <!-- Tabs -->
                <div class="tabNavigationBar-tab border_style">
                    <a href="{{ route('task.list-view') }}" class="tabNavigationBar-item @if(request()->routeIs('task.list-view')) active @endif" wire:navigate ><i class='bx bx-list-ul'></i> List</a>
                    <a href="{{ route('task.index') }}" class="tabNavigationBar-item @if(request()->routeIs('task.index')) active @endif" wire:navigate><i class='bx bx-columns' ></i> Board</a>
                </div>
            </div>
            <div class="col-md-6 text-end">
             @if(auth()->user()->is_manager)
                <div class="form-check form-switch d-inline-block">
                    <input class="form-check-input task-switch" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                    <label class="form-check-label task-switch-text" for="flexSwitchCheckChecked">
                        @if($ViewTasksAs == 'manager')
                        Showing {{ auth()->user()->myTeam->name }} Tasks
                        @else
                        Showing My Tasks
                        @endif
                    </label>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="btn-list">
        <a wire:click="$set('status', 'all')" class="btn-border btn-border-primary @if($status == 'all') active @endif">
            {{ $tasks['pending']->count() + $tasks['in_progress']->count() + $tasks['in_review']->count() + $tasks['completed']->count() }} 
            <span>|</span>
             All
        </a>
        <a wire:click="$set('status', 'pending')" class="btn-border btn-border-primary @if($status == 'pending') active @endif">{{ $tasks['pending']->count() }} <span>|</span> Assigned</a>
        <a wire:click="$set('status', 'in_progress')" class="btn-border btn-border-secondary @if($status == 'in_progress') active @endif">{{ $tasks['in_progress']->count() }} <span>|</span> Accepted</a>
        <a wire:click="$set('status', 'in_review')" class="btn-border btn-border-warning @if($status == 'in_review') active @endif">{{ $tasks['in_review']->count() }} <span>|</span> In Review</a>
        <a wire:click="$set('status', 'completed')" class="btn-border btn-border-success @if($status == 'completed') active @endif">{{ $tasks['completed']->count() }} <span>|</span> Completed</a>
        <a wire:click="$set('status', 'overdue')" class="btn-border btn-border-danger @if($status == 'overdue') active @endif">
            @php
                $overdue = $tasks['pending']->where('due_date', '<', now())->count();
                $overdue += $tasks['in_progress']->where('due_date', '<', now())->count();
                $overdue += $tasks['in_review']->where('due_date', '<', now())->count();
            @endphp
            {{ $overdue }}
            <span>|</span> Overdue</a>
    </div>

    <!-- Filters Query Params -->
     @if($this->doesAnyFilterApplied())
        <div class="d-flex flex-wrap gap-2 align-items-center mt-3 mb-2">
            <span class="pe-2"><i class='bx bx-filter-alt text-secondary'></i> Filter Results:</span>
                @if($sort != 'all')
                    <span class="btn-batch">
                        @if($sort == 'newest') Newest @endif
                        @if($sort == 'oldest') Oldest @endif
                        @if($sort == 'a_z') A to Z @endif
                        @if($sort == 'z_a') Z to A @endif
                        <a wire:click="$set('sort','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif

                @if($status != 'all')
                    <span class="btn-batch">
                        @if($status == 'pending') Active @endif
                        @if($status == 'overdue') Overdue @endif
                        @if($status == 'completed') Completed @endif
                        @if($status == 'in_progress') Accepted @endif
                        @if($status == 'in_review') In Review @endif

                        <a wire:click="$set('status','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif
            
                @if($byClient != 'all')
                    <span class="btn-batch">{{ $clients->find($byClient)->name }} <a wire:click="$set('byClient','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif

                @if($byProject != 'all')
                    <span class="btn-batch">{{ $projects->find($byProject)->name }} <a wire:click="$set('byProject','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif

                @if($byUser != 'all')
                    <span class="btn-batch">{{ $users->find($byUser)->name }} <a wire:click="$set('byUser','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif

                @if($startDate)
                    <span class="btn-batch">{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} <a wire:click="$set('startDate','')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif

                @if($dueDate)
                    <span class="btn-batch">{{ \Carbon\Carbon::parse($dueDate)->format('d M Y') }} <a wire:click="$set('dueDate','')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif

            <a href="{{ route('task.index') }}" class="text-danger d-flex align-items-center">Reset <span class="ms-1 d-inline-flex"><i class='bx bx-refresh'></i></span></a>
        </div>
    @endif

    <div class="column-box mt-3">
        <div class="taskList-dashbaord_header">
            <div class="row">
                <div class="col-lg-4">
                    <div class="taskList-dashbaord_header_title taskList_col ms-2">Task Name</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Created Date</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Due Date</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Project</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Assignee</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Status</div>
                </div>
            </div>
        </div>
        <div class="taskList scrollbar">
            <div>
                @php
                    $groups = ['pending','in_progress','in_review','completed'];
                @endphp
                @foreach($groups as $group)
                    @foreach($tasks[$group] as $task)
                        <div class="taskList_row edit-task" data-id="{{ $task->id }}"  wire:key="task-row-{{ $task->id }}">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_open edit-task" data-id="{{ $task->id }}"><i class="bx bx-chevron-right"></i></div>
                                        <div class="edit-task" data-id="{{ $task->id }}">
                                            <div>{{ $task->name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <div class="taskList_col"><span>{{  Carbon\Carbon::parse($task->created_at)->format('d M Y') }}</span></div>
                                </div>
                                <div class="col text-center">
                                    <div class="taskList_col"><span class="btn-batch ">{{  Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</span></div>
                                </div>
                                <div class="col text-center">
                                    <div class="taskList_col"><span>{{ $task->project->name }}</span></div>
                                </div>
                                <div class="col text-center">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            @foreach($task['users'] as $user)
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm avatar-{{$user->color}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                    <div class="rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">{{ $user->initials }}</div>
                                                </span>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <div class="taskList_col">
                                        <span class="btn-batch btn-batch-primary">
                                            @if($task->status == 'pending') Assigned @endif
                                            @if($task->status == 'in_progress') Accepted @endif
                                            @if($task->status == 'in_review') In Review @endif
                                            @if($task->status == 'completed') Completed @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    {{-- <div class="taskList-dashbaord">
        <div class="taskList-wrap">
            <div class="taskList-dashbaord_tabs">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="task_list_tab_assigned-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_assigned" type="button" role="tab" aria-controls="task_list_tab_assigned" aria-selected="true">Assigned</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task_list_tab_progress-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_progress" type="button" role="tab" aria-controls="task_list_tab_progress" aria-selected="false">In Progress</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task_list_tab_review-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_review" type="button" role="tab" aria-controls="task_list_tab_review" aria-selected="false">In Review</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task_list_tab_complete-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_complete" type="button" role="tab" aria-controls="task_list_tab_complete" aria-selected="false">Completed</button>
                    </li>
                </ul>
                <div class="taskList-dashbaord_header">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="taskList-dashbaord_header_title taskList_col">Task Name</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Due Date</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Projects</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Assignee</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Notify</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Status</div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="task_list_tab_assigned" role="tabpanel" aria-labelledby="task_list_tab_assigned-tab" tabindex="0">
                        <div class="taskList">
                            @foreach($tasks['pending'] as $task)
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm({{$task['id']}})"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col"><span class="btn-batch">{{  Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</span></div>
                                        </div>
                                        <div class="col text-center">
                                            @if($task->project)
                                                <div class="taskList_col"><span class="btn-batch">{{ $task->project->name }}</span></div>
                                            @else
                                                <div class="taskList_col">-</div>
                                            @endif
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="avatarGroup avatarGroup-overlap">
                                                    @foreach($task['users'] as $user)
                                                    <a href="#" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                            {{-- <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" /> 
                                                            <div class="rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">{{ $user->initials }}</div>
                                                        </span>
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="avatarGroup avatarGroup-overlap">
                                                    @foreach($task['users'] as $user)
                                                    <a href="#" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                            {{-- <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" /> 
                                                            <div class="rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">{{ $user->initials }}</div>
                                                        </span>
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="taskList_col">
                                                <div class="icon_group justify-content-center">
                                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="task_list_tab_progress" role="tabpanel" aria-labelledby="task_list_tab_progress-tab" tabindex="0">
                        <div>
                            @foreach($tasks['in_progress'] as $task)
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm({{$task['id']}})"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">{{  Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</div>
                                        </div>
                                        <div class="col text-center">
                                            @if($task->project)
                                                <div class="taskList_col">{{ $task->project->name }}</div>
                                            @else
                                                <div class="taskList_col">-</div>
                                            @endif
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
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
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="taskList_col">
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
                                        <div class="col">
                                            <div class="taskList_col">
                                                <div class="icon_group justify-content-center">
                                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="task_list_tab_review" role="tabpanel" aria-labelledby="task_list_tab_review-tab" tabindex="0">
                        <div>
                            @foreach($tasks['in_review'] as $task)
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm({{$task['id']}})"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">{{  Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</div>
                                        </div>
                                        <div class="col text-center">
                                            @if($task->project)
                                                <div class="taskList_col">{{ $task->project->name }}</div>
                                            @else
                                                <div class="taskList_col">-</div>
                                            @endif
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
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
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="taskList_col">
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
                                        <div class="col">
                                            <div class="taskList_col">
                                                <div class="icon_group justify-content-center">
                                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="task_list_tab_complete" role="tabpanel" aria-labelledby="task_list_tab_complete-tab" tabindex="0">
                        <div>
                            @foreach($tasks['completed'] as $task)
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm({{$task['id']}})"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">{{  Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</div>
                                        </div>
                                        <div class="col text-center">
                                            @if($task->project)
                                                <div class="taskList_col">{{ $task->project->name }}</div>
                                            @else
                                                <div class="taskList_col">-</div>
                                            @endif
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
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
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="taskList_col">
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
                                        <div class="col">
                                            <div class="taskList_col">
                                                <div class="icon_group justify-content-center">
                                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
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
    </div> --}}
    <livewire:components.add-task @saved="$refresh"  />
</div>

@script
    <script>
        document.addEventListener('saved', function(){
            $('#offcanvasRight').offcanvas('hide');
        });

        $(".edit-task").click(function(){
            let taskId = $(this).data('id');
            @this.emitEditTaskEvent(taskId);
        });

        $(".start_date").flatpickr({
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance){
                @this.set('startDate', dateStr);
                $(".start_date").text(dateStr);
            }
        });

        $(".due_date").flatpickr({
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance){
                @this.set('dueDate', dateStr);
                $(".due_date").text(dateStr);
            }
        });

        $(".task-switch").change(function(){
            if($(this).is(':checked')){
                // $(".task-switch-text").text('Show Team Tasks');
                @this.set('ViewTasksAs', 'manager');
            }else{
                // $(".task-switch-text").text('Show My Tasks');
                @this.set('ViewTasksAs', 'user');
            }
        });
    </script>
@endscript


