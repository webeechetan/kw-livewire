<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('task.index') }}"><i class='bx bx-line-chart'></i>{{ Auth::user()->organization ? Auth::user()->organization->name : 'No organization' }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Tasks</li>
        </ol>
    </nav>

    <!-- Dashboard Header -->
    <div class="dashboard-head pb-0 mb-4">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">My Tasks</h3>
                <span class="text-light">|</span>
                @can('Create Task')
                    <a data-step="1" data-intro='Create your first task' data-position='right' data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" href="javascript:void(0);" class="btn-border btn-sm btn-border-primary toggleForm"><i class="bx bx-plus"></i> Add Task</a>
                @endcan
            </div>
            <div class="col-auto">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="" data-step="2" data-intro='Search Task' data-position='bottom'>
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Task">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                    <div class="main-body-header-filters" data-step="3" data-intro='Filter Task' data-position='bottom'>
                        <div class="cus_dropdown" wire:ignore.self>
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
                                                        <i class='bx bx-calendar-alt' ></i> End Date
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-calendar-alt text-primary' ></i> Filter By Status</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a wire:click="$set('status', 'all')" class="btn-batch @if($status == 'all') active @endif">All</a></li>
                                            {{-- <li class="filterSort_item "><a wire:click="$set('status', 'pending')" class="btn-batch @if($status == 'pending') active @endif">Assigned</a></li> --}}
                                            {{-- <li class="filterSort_item"><a wire:click="$set('status', 'in_progress')" class="btn-batch @if($status == 'in_progress') active @endif">Accepted</a></li> --}}
                                            {{-- <li class="filterSort_item"><a wire:click="$set('status', 'in_review')" class="btn-batch @if($status == 'in_review') active @endif">In Review</a></li> --}}
                                            <li class="filterSort_item"><a wire:click="$set('status', 'overdue')" class="btn-batch @if($status == 'overdue') active @endif">Overdue</a></li>
                                            {{-- <li class="filterSort_item"><a wire:click="$set('status', 'completed')" class="btn-batch @if($status == 'completed') active @endif">Completed</a></li> --}}
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
                    {{-- <a href="{{ route('task.list-view') }}" class="tabNavigationBar-item @if(request()->routeIs('task.list-view')) active @endif" wire:navigate ><i class='bx bx-list-ul'></i> List</a>
                    <a href="{{ route('task.index') }}" class="tabNavigationBar-item @if(request()->routeIs('task.index')) active @endif" wire:navigate><i class='bx bx-columns' ></i> Board</a> --}}

                   
                    {{-- <a  wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.list-view') active @endif" href="{{ route('task.list-view') }}"> <i class='bx bx-list-ul'></i> {{$currentRoute}} List</a>
                    <a wire:navigate  class="tabNavigationBar-item @if($currentRoute =='task.index') active @endif" href ="{{route('task.index') }}"><i class='bx bx-columns' ></i> {{$currentRoute}} Board</a> --}}
                
                    <a wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.list-view') active @endif" href="{{ route('task.list-view') }}">
                        <i class='bx bx-list-ul'></i> List
                    </a>
                    <a wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.index') active @endif" href="{{ route('task.index') }}">
                        <i class='bx bx-columns'></i> Board
                    </a>
                    
                </div>
            </div>
            <div class="col-md-6 text-end">
                @if(auth()->user()->is_manager)
                <div class="form-check form-switch d-inline-block">
                    <input class="form-check-input task-switch" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                    <label class="form-check-label task-switch-text" for="flexSwitchCheckChecked">Showing {{ auth()->user()->myTeam->name }} Tasks</label>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Filters Query Params -->
    @if($this->doesAnyFilterApplied())
        <x-filters-query-params 
            :sort="$sort" 
            :status="$status" 
            :byUser="$byUser" 
            :byClient="$byClient"
            :byProject="$byProject"
            :startDate="$startDate" 
            :dueDate="$dueDate" 
            :users="$users" 
            :teams="$teams"
            :clients="$clients"
            :projects="$projects"
            :clearFilters="route('task.index')"
        />
    @endif

    <!-- Kanban -->
    <div class="kanban_bord" >
        <div class="kanban_bord_body_columns" wire:sortable-group="updateTaskOrder">
            @php
                $groups = ['pending','in_progress','in_review','completed'];
                $task_count = 0;
                $task_count = count($tasks['pending']) + count($tasks['in_progress']) + count($tasks['in_review']) + count($tasks['completed']);
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
                            <div wire:loading.class="opacity-25" class="kanban_column_task {{ $date_class }}" wire:key="task-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}" >
                                <div wire:loading wire:target="emitEditTaskEvent({{ $task['id'] }})" class="card_style-loader">
                                    <div class="card_style-loader-wrap"><i class='bx bx-pencil text-primary me-2' ></i> Loading ...</div>
                                </div> 
                                <div class="kanban_column_task-wrap" wire:sortable-group.handle>
                                    <div class="kanban_column_task_name">
                                        <div class="kanban_column_task_complete_icon d-none">
                                            <i class='bx bx-check' ></i>
                                        </div>
                                        <div class="kanban_column_task_name_text">
                                            <h4 wire:click="emitEditTaskEvent({{ $task['id'] }})" class="edit-task fs-6" data-id="{{$task['id']}}">{{ $task['name'] }}</h4>
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
                                                @php
                                                    $plus_more_users = 0;
                                                    if(count($task['users']) > 3){
                                                        $plus_more_users = count($task['users']) - 3;
                                                    }
                                                @endphp

                                                @foreach($task['users']->take(3) as $user)
                                                    {{-- <a href="javascript:;" class="avatar avatar-sm avatar-{{$user->color}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{$user->name}}">{{$user->initials}}</a> --}}
                                                    <x-avatar :user="$user" class="avatar-sm" />
                                                @endforeach

                                                @if($plus_more_users)
                                                    <a href="#" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm avatar-more">+{{$plus_more_users}}</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @if($totalTasks > 0 && $task_count < $totalTasks)
                                <div class="text-center">
                                    <a href="javascript:;" class="" wire:click="loadMore">
                                        <i class="bx bx-down-arrow-alt"></i>
                                        <span wire:loading wire:target="loadMore" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
            @endforeach
            
        </div>
    </div>
</div>

@script
<script>

   
    // trigger @this.loadMore() when scroll to bottom

    // setTimeout(function(){
    //     console.log('timeout');
    //     window.addEventListener('scroll', function(){
    //         console.log('scroll to bottom');
    //         if(window.scrollY + window.innerHeight >= document.body.scrollHeight){
    //             @this.loadMore();
    //         }
    //         console.log(window.scrollY + window.innerHeight, document.body.scrollHeight);
    //     }, {passive: true});

    // }, 3000);


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

@php
    $tour = session()->get('tour');
@endphp

{{-- @if($tour['task_tour']) --}}
@if(isset($tour) && $tour != null && isset($tour['task_tour']))
    @assets
        <link href="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/minified/introjs.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/intro.min.js"></script>
    @endassets
@endif

{{-- @if($tour['task_tour']) --}}
@if(isset($tour) && $tour != null && isset($tour['task_tour']))
    @script
            <script>
                introJs()
                .setOptions({
                showProgress: true,
                })
                .onbeforeexit(function () {
                    location.href = "{{ route('task.index') }}?tour=close-task-tour";
                })
                .start();
            </script>
    @endscript
@endif

