<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i>{{ ucfirst(Auth::user()->organization->name) }}</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('task.index') }}">Tasks</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
    </nav>

    <!-- Dashboard Header --> 
    <div class="dashboard-head pb-0 mb-4">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">Tasks</h3>
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
                                                        <i class='bx bx-calendar-alt' ></i> Due Date
                                                    @endif
                                                </a>
                                            </div>
                                        </div> 
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-calendar-alt text-primary' ></i> Filter By Statuss</h5>
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
                    <a wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.list-view') active @endif" href="{{ route('task.index') }}">
                        <i class='bx bx-columns'></i> My Tasks
                    </a>
    
                    <a wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.projects') active @endif" href="{{ route('task.projects') }}">
                        <i class='bx bx-objects-horizontal-left'></i> Projects 
                    </a>
    
                    <a wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.teams') active @endif" href="{{ route('task.teams') }}">
                        <i class='bx bx-sitemap'></i> Teams 
                    </a>
                    {{-- <span>
                        <select name="" id="">
                            <option value="">Team A</option>
                            <option value="">Team B</option>
                            <option value="">Team C</option>
                        </select>
                    </span> --}}
                
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="d-inlineflex flex-wrap align-items-center">
                    <div class="form-check form-switch d-inline-block">
                        <input class="form-check-input assigned-by-me-task-task-switch"
                        @if($ViewTasksAs == 'manager')
                            disabled
                        @endif
                        type="checkbox" role="switch" id="">
                        <label class="form-check-label assigned-by-me-task-switch-text" for="">Assigned By Me</label>
                    </div> 
                    @if(auth()->user()->is_manager)
                    |
                    <div class="form-check form-switch d-inline-block">
                        <input class="form-check-input task-switch" 
                        @if($assignedByMe)
                            disabled
                        @endif
                        type="checkbox" role="switch" id="flexSwitchCheckChecked">
                        <label class="form-check-label task-switch-text" for="flexSwitchCheckChecked">Showing {{ auth()->user()->myTeam->name }} Tasks</label>
                    </div>
                    @endif
                    <a wire:navigate class="ms-4" href="{{ route('task.index') }}">
                        <i class='bx bx-columns'></i>
                    </a>
                    <span class="text-light mx-2">|</span>
                    <a wire:navigate class="text-primary" href="{{ route('task.list-view') }}">
                        <i class='bx bx-list-ul'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="btn-list">
        <a wire:click="$set('status', 'all')" class="btn-border btn-border-primary @if($status == 'all') active @endif">
            {{-- {{ $tasks['pending']->count() + $tasks['in_progress']->count() + $tasks['in_review']->count() + $tasks['completed']->count() }}  --}}
            {{ $allTasks}}
            <span>|</span> 
             All 
        </a>


        {{-- <a href="javascript:" wire:click="$set('status', 'pending')" class="btn-border btn-border-sm btn-border-primary "><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('status', 'pending')->count() }} Assigned</a> --}}

        <a  wire:click="$set('status', 'pending')" class="btn-border btn-border-primary @if($status == 'pending') active @endif">{{ $pendingTasks}} <span>|</span> Assigned</a>
        <a  wire:click="$set('status', 'in_progress')" class="btn-border btn-border-secondary @if($status == 'in_progress') active @endif">{{ $inProgressTasks}} <span>|</span> Accepted</a>
        <a  wire:click="$set('status', 'in_review')" class="btn-border btn-border-warning @if($status == 'in_review') active @endif">{{  $inReviewTasks }} <span>|</span> In Review</a>
        <a  wire:click="$set('status', 'completed')" class="btn-border btn-border-success @if($status == 'completed') active @endif">{{ $completedTasks }} <span>|</span> Completed</a>
       

        {{-- <a wire:click="$set('status', 'pending')" class="btn-border btn-border-primary @if($status == 'pending') active @endif">{{ $tasks_count->where('status','pending')->count() }} <span>|</span> Assigned</a>
        <a wire:click="$set('status', 'in_progress')" class="btn-border btn-border-secondary @if($status == 'in_progress') active @endif">{{ $tasks_count->where('status','in_progress')->count() }} <span>|</span> Accepted</a>
        <a wire:click="$set('status', 'in_review')" class="btn-border btn-border-warning @if($status == 'in_review') active @endif">{{ $tasks_count->where('status','in_review')->count() }} <span>|</span> In Review</a>
        <a wire:click="$set('status', 'completed')" class="btn-border btn-border-success @if($status == 'completed') active @endif">{{ $tasks_count->where('status','completed')->count() }} <span>|</span> Completed</a> --}}
        <a wire:click="$set('status', 'overdue')" class="btn-border btn-border-danger @if($status == 'overdue') active @endif">
           {{ $overdueTasks }}
            <span>|</span> Overdue</a>
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
            :clearFilters="route('task.list-view')"
        />
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
                    <div class="taskList-dashbaord_header_title taskList_col">Projects</div>
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
                    $hasTasks = false;
                @endphp
                
                @foreach($groups as $group)
                @if(!empty($tasks[$group]) && count($tasks[$group]) > 0)
                @php
                    $hasTasks = true;
                @endphp
                    @foreach($tasks[$group] as $task)
                    @if(!$task->project)
                        @continue
                    @endif
                  

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
                                    <div class="taskList_col"><span class="btn-batch 
                                        @if ($task->due_date < \Carbon\Carbon::now())  btn-batch btn-batch-danger @endif"> @if($task->due_date)
                                        {{ Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                    @else
                                        No Due Date
                                    @endif</span></div>
                                </div>
                                <div class="col text-center">
                                    <div class="taskList_col"><span>{{ $task->project->name }}</span></div>
                                </div>
                                <div class="col text-center">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">

                                            @php
                                            $plus_more_users = 0;
                                                if(count($task['users']) > 3){
                                                    $plus_more_users = count($task['users']) - 3;
                                                }
                                            @endphp

                                            @foreach($task['users']->take(3) as $user)
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
                                <div class="col text-center">
                                    <div class="taskList_col">
                                        {{-- <span class="btn-batch btn-batch-primary"> --}}

                                            <span class="btn-batch 
                                            @if($task->status == 'pending') btn-batch-primary 
                                            @elseif ($task->status == 'in_progress') btn-batch-secondary
                                            @elseif( $task->status == 'in_review') btn-batch-warning
                                            @elseif( $task->status == 'completed') btn-batch-success
                                            @endif" 
                                            >

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
                    @endif
                @endforeach

                @if(!$hasTasks)
                <div class="col-md-12 text-center">
                    <img src="{{ asset('assets/images/'.'invite_signup_img.png') }}" width="150" alt="">
                    <h5 class="text text-light mt-3">No Tasks found</h5>
                </div>
                @endif
               
            </div>
        </div>
    </div>

    {{-- <livewire:components.add-task @saved="$refresh"  /> --}}
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
                @this.set('ViewTasksAs', 'manager');
            }else{
                @this.set('ViewTasksAs', 'user');
            }
        });

        $(".assigned-by-me-task-task-switch").change(function(){
            if($(this).is(':checked')){
                @this.set('assignedByMe', true);
            }else{
                @this.set('assignedByMe', false);
            }
        });
    </script>
@endscript


