<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
        </ol>
    </nav>

    <livewire:projects.components.project-tabs :project="$project" />

    <div class="col-md-12">
        <div class="column-box h-100">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div><h4 class="column-title mb-0"><i class='bx bx-objects-horizontal-left text-primary' ></i> {{ $tasks->count() }} Tasks</h4></div>
                <!-- Filters Query Params -->
                @if($this->doesAnyFilterApplied())
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-end mb-2">
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
                                            @if($status == 'pending') Assigned @endif
                                            @if($status == 'overdue') Overdue @endif
                                            @if($status == 'completed') Completed @endif
                                            @if($status == 'in_progress') In Progress @endif
                                            @if($status == 'in_review') In Review @endif
                                            <a wire:click="$set('status','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
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
                                    
                                    <a href="{{ route('project.tasks',$project->id) }}" class="text-danger d-flex align-items-center">Reset <span class="ms-1 d-inline-flex"><i class='bx bx-refresh'></i></span></a>
                                </div>
                        </div>
                    @endif
                <div class="btn-list">
                    <a href="javascript:;" class="btn-sm btn-border btn-border-primary open-add-task-canvas" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class='bx bx-plus' ></i> Add Task</a>
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
            <hr class="space-sm">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="btn-list">
                        <a href="javascript:" wire:click="$set('status', 'pending')" class="btn-border btn-border-sm btn-border-primary "><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('status', 'pending')->where('due_date', '>', now())->count() }} Assigned</a>
                        <a href="javascript:" wire:click="$set('status', 'in_progress')" class="btn-border btn-border-sm btn-border-secondary "><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('status', 'in_progress')->count() }} Accepted</a>
                        <a href="javascript:" wire:click="$set('status', 'in_review')" class="btn-border btn-border-sm btn-border-warning "><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('status', 'in_review')->count() }} In Review</a>
                        <a href="javascript:" wire:click="$set('status', 'overdue')" class="btn-border btn-border-sm btn-border-danger"><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('due_date', '<', now())->count() }} Overdue</a>
                        <a href="javascript:" wire:click="$set('status', 'completed')" class="btn-border btn-border-sm btn-border-success"><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('status', 'completed')->count() }} Completed</a>
                    </div>
                </div>
                <div class="col-lg-6 ms-auto text-end">
                    <form class="search-box search-box-float-style" wire:submit="search">
                        <span class="search-box-float-icon"><i class='bx bx-search'></i></span>
                        <input type="text" wire:model="query" class="form-control" placeholder="Search Task...">
                    </form>
                </div>
            </div>
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
                    @foreach($tasks as $task)
                  
                    <div class="taskList_row" wire:key="task-row-{{ $task->id }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="taskList_col taskList_col_title">
                                    <div class="taskList_col_title_open edit-task" data-id="{{ $task->id }}"><i class='bx bx-chevron-right' ></i></div>
                                    <div class="edit-task" data-id="{{ $task->id }}">
                                        <div>{{ $task->name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span>{{ \Carbon\Carbon::parse($task->created_at)->format('d M Y') }}</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span class="btn-batch @if ($task->due_date < \Carbon\Carbon::now())  btn-batch btn-batch-danger @endif">{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span>{{ $project->name }}</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col">
                                    <div class="avatarGroup avatarGroup-overlap">

                                        @php
                                        $plus_more_users = 0;
                                            if(count($task->users) > 3){
                                                $plus_more_users = count($task->users) - 3;
                                            }
                                        @endphp

                                        @foreach($task->users->take(3) as $user)
                                            @if($user->image)
                                                <a href="javascript:" wire-key="task-user-{{$user->id}}" class="avatarGroup-avatar">
                                                    <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                        <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle" />
                                                    </span>
                                                </a>
                                            @else
                                                <a href="#" class="avatarGroup-avatar">
                                                    <span class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">{{ $user->initials }}</span>
                                                </a>
                                            @endif
                                        @endforeach

                                        @if($plus_more_users)
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm avatar-more">+{{$plus_more_users}}</span>
                                        </a>
                                    @endif    

                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span class="btn-batch 
                                    @if($task->status == 'pending') btn-batch-primary 
                                    @elseif ($task->status == 'in_progress') btn-batch-danger 
                                    @elseif ($task->status == 'in_review') btn-batch-success 
                                    @elseif ($task->status == 'completed') btn-batch-warning 
                                    @endif"
                                >
                                    @if($task->status == 'pending')
                                        Assigned
                                    @elseif($task->status == 'in_progress')
                                        Accepted
                                    @elseif($task->status == 'in_review')
                                        In Review
                                    @elseif($task->status == 'completed')
                                        Completed
                                    @endif
                                </span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{-- {{  $tasks->links()  }} --}}
        </div>
    </div>
    <livewire:components.add-task @saved="$refresh" :project="$project" wire:key="task-{{$project->id}}"  />
</div>

@script
    <script>
        $(".edit-task").click(function(){
            let taskId = $(this).data('id');
            @this.emitEditTaskEvent(taskId);
        });

        document.addEventListener('saved', function(){
            $('#offcanvasRight').offcanvas('hide');
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

        
    </script>
@endscript

