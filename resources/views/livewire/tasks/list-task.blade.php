<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Webeesocial</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Tasks</li>
        </ol>
    </nav>

    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Tasks</h3>
                <span class="text-light">|</span>
                @can('Create Task')
                    <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary toggleForm"><i class="bx bx-plus"></i> Add Task</a>
                @endcan
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Company">
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
                                                <a wire:navigate href="{{ route('task.index',['sort'=>'newest','filter'=>$filter, 'byProject'=> $byProject])}}" class="btn-batch @if($sort == 'newest') active @endif " >Newest</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="{{ route('task.index',['sort'=>'a_z','filter'=>$filter, 'byProject'=> $byProject])}}" class="btn-batch @if($sort == 'a_z') active @endif"><i class='bx bx-down-arrow-alt' ></i> A To Z</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="{{ route('task.index',['sort'=>'z_a','filter'=>$filter, 'byProject'=> $byProject])}}" class="btn-batch @if($sort == 'z_a') active @endif"><i class='bx bx-up-arrow-alt' ></i> Z To A</a>
                                            </li>
                                        </ul>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-calendar-alt text-primary' ></i> Filter By Date</h5>
                                        <div class="row align-items-center mt-2">
                                            <div class="col mb-4 mb-md-0">
                                                <a href="javascript:;" class="btn w-100 btn-sm btn-border-secondary project_start_date"><i class='bx bx-calendar-alt' ></i> Start Date</a>
                                            </div>
                                            <div class="col-auto text-center font-500 mb-4 mb-md-0 px-0">To</div>
                                            <div class="col">
                                                <a href="javascript:;" class="btn w-100 btn-sm btn-border-danger project_due_date"><i class='bx bx-calendar-alt' ></i> Due Date</a>
                                            </div>
                                        </div>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                                        <select class="dashboard_filters-select w-100" name="" id="">
                                            <option value="" disabled="">Select Client</option>
                                            <option value="1">Acma</option>
                                            <option value="2">Buyers Guide</option>
                                            <option value="3">GRG</option>
                                            <option value="4">Webeesocial</option>
                                        </select>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By Projects</h5>
                                        <select class="dashboard_filters-select w-100" wire:model.live="byProject">
                                            <option value="all">All</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-user text-primary'></i> Filter By User</h5>
                                        <select class="dashboard_filters-select mt-2 w-100" name="" id="">
                                            <option value="" disabled="">Select Client</option>
                                            <option value="1">Acma</option>
                                            <option value="2">Buyers Guide</option>
                                            <option value="3">GRG</option>
                                            <option value="4">Webeesocial</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabs -->
    <div class="tabNavigationBar-tab border_style my-2">
        <a href="{{ route('task.list-view') }}" class="tabNavigationBar-item @if(request()->routeIs('task.list-view')) active @endif" wire:navigate ><i class='bx bx-list-ul'></i> List</a>
        <a href="{{ route('task.index') }}" class="tabNavigationBar-item @if(request()->routeIs('task.index')) active @endif" wire:navigate><i class='bx bx-columns' ></i> Board</a>
    </div>
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
                            Assigned <span class="btn-batch">50</span>
                        @elseif($group == 'in_progress')
                            Accepted <span class="btn-batch">100</span>
                        @elseif($group == 'in_review')
                            In Review <span class="btn-batch">10</span>
                        @elseif($group == 'completed')
                            Completed <span class="btn-batch">72</span>
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
                                                    <li><a class="edit-task" data-id="{{$task['id']}}"><span class="text-secondary"><i class="bx bx-pencil"></i></span> Edit</a></li>
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
                                            <h4 wire:click="enableEditForm({{$task['id']}})" class="fs-6">{{ $task['name'] }}</h4>
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
                                                <a href="javascript:;" class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Aadil Prasad Brahmbhatt">AP</a>
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
    
</script>
@endscript
