<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Webeesocial</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Tasks</li>
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

    <!-- Filters Query Params -->
    @if($this->doesAnyFilterApplied())
        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
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
               
                @if($startDate)
                    <span class="btn-batch">{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} <a wire:click="$set('startDate','')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif

                @if($dueDate)
                    <span class="btn-batch">{{ \Carbon\Carbon::parse($dueDate)->format('d M Y') }} <a wire:click="$set('dueDate','')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif
            <a href="{{ route('task.index') }}" class="text-danger d-flex align-items-center">Reset <span class="ms-1 d-inline-flex"><i class='bx bx-refresh'></i></span></a>
        </div>
    @endif

    <!-- Kanban -->
    <div class="kanban_bord">
        <div class="kanban_bord_body_columns" wire:sortable-group="updateTaskOrder">
            @php
                $groups = ['pending','in_progress','in_review','completed'];
            @endphp
            @foreach($groups as $group)
                @php
                    $board_class = '';
                    if($group=='pending'){
                        $board_class = 'kanban_bord_column_assigned';
                    }
                    if($group=='in_progress'){
                        $board_class = 'kanban_bord_column_accepted';
                    }
                    if($group=='in_review'){
                        $board_class = 'kanban_bord_column_in_review';
                    }
                    if($group=='completed'){
                        $board_class = 'kanban_bord_column_completed';
                    }
                @endphp
                <div class="kanban_bord_column {{ $board_class }}" wire:key="group-{{$group}}"  wire:sortable.item="{{ $group  }}">
                    <div class="kanban_bord_column_title" wire:sortable.handle>
                        @if($group == 'pending')
                            Assigned <span class="btn-batch">{{ count($tasks[$group]) }}</span>
                        @elseif($group == 'in_progress')
                            Accepted <span class="btn-batch">{{ count($tasks[$group]) }}</span>
                        @elseif($group == 'in_review')
                            In Review <span class="btn-batch">{{ count($tasks[$group]) }}</span>
                        @elseif($group == 'completed')
                            Completed <span class="btn-batch">{{ count($tasks[$group]) }}</span>
                        @endif
                    </div>
                    <div class="kanban_column scrollbar" wire:sortable-group.item-group="{{$group}}" wire:sortable-group.options="{ 
                        animation: 400 ,
                        easing: 'cubic-bezier(1, 0, 0, 1)',
                        onStart: function (evt) {
                            console.log(evt);
                            // change the color of the dragging item
                            evt.item.style.background = '#fff';
                        },
                    }">
                        @if(!count($tasks[$group]))
                        <div class="kanban_column_empty"><i class='bx bx-add-to-queue'></i></div>
                        @endif
                        @foreach($tasks[$group] as $task)
                            @php
                                $date_class = '';
                                if($task['due_date'] < date('Y-m-d')){
                                    $date_class = 'kanban_column_task_overdue';
                                }
                                if($task['due_date'] == date('Y-m-d')){
                                    $date_class = 'kanban_column_task_warning';
                                }
                                
                            @endphp
                            <div class="kanban_column_task {{ $date_class }}" wire:key="task-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}" >
                                <div class="kanban_column_task-wrap" wire:sortable-group.handle>
                                    <div class="cus_dropdown cus_dropdown-edit z-0">
                                        <div class="cus_dropdown-icon"><i class="bx bx-dots-horizontal-rounded"></i></div>
                                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                            <div class="cus_dropdown-body-wrap">
                                                <ul class="cus_dropdown-list">
                                                    <li><a><span class="text-secondary"><i class="bx bx-pencil"></i></span> Edit</a></li>
                                                    <li><a href="#"><span class="text-danger"><i class="bx bx-trash"></i></span> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kanban_column_task_name">
                                        <div class="kanban_column_task_complete_icon d-none">
                                            <i class='bx bx-check' ></i>
                                        </div>
                                        <div class="kanban_column_task_name_text">
                                            <h4 class="edit-task fs-6" data-id="{{$task['id']}}">{{ $task['name'] }}</h4>
                                            <div class="kanban_column_task_project_name">
                                                <span class="text-black">
                                                    @if($task['project'])
                                                    <i class='bx bx-file-blank' ></i>  {{ $task['project']['name'] }} 
                                                    @endif
                                                </span>
                                                <span class="text-black">
                                                    @if(count($task['comments']) > 0)
                                                    <i class='bx bx-chat' ></i>  {{ count($task['comments'])  }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    <div class="kanban_column_task_bot mt-0 pt-0 border-top-0">
                                        <div class="kanban_column_task_actions">
                                            <a href="#" class="kanban_column_task_date task">
                                                <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                                <span class="">{{  \Carbon\Carbon::parse($task['due_date'])->format('d M Y') }}</span>
                                            </a>
                                        </div>
                                        <div>
                                            <div class="avatarGroup avatarGroup-overlap">
                                                @foreach($task['users'] as $user)
                                                <a href="javascript:;" class="avatar avatar-sm avatar-{{$user->color}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{$user->name}}">{{$user->initials}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <livewire:components.add-task @saved="$refresh"  />
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

    $(".task-switch").change(function(){
        if($(this).is(':checked')){
            // $(".task-switch-text").text('Show Team Tasks');
            @this.set('ViewTasksAs', 'manager');
        }else{
            // $(".task-switch-text").text('Show My Tasks');
            @this.set('ViewTasksAs', 'user');
        }
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
