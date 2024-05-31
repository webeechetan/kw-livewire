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
                <div><h4 class="column-title mb-0"><i class='bx bx-objects-horizontal-left text-primary' ></i> {{ $project->tasks->count() }} Tasks</h4></div>
                <div class="btn-list">
                    <a href="javascript:;" class="btn-sm btn-border btn-border-primary open-add-task-canvas" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class='bx bx-plus' ></i> Add Task</a>
                    <div class="cus_dropdown">
                        <div class="cus_dropdown-icon btn-border btn-border-secondary"><i class='bx bx-filter-alt' ></i> Filter</div>
                        <div class="cus_dropdown-body cus_dropdown-body-widh_l">
                            <div class="cus_dropdown-body-wrap">
                                <div class="filterSort">
                                    <h5 class="filterSort-header"><i class='bx bx-sort-down text-primary' ></i> Sort By</h5>
                                    <ul class="filterSort_btn_group list-none">
                                        {{-- <li class="filterSort_item"><a wire:navigate href="{{ route('project.profile',['id' => $project->id ,'sort'=>'newest','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'newest') active @endif">Newest</a></li>
                                        <li class="filterSort_item"><a wire:navigate href="{{ route('project.profile',['id' => $project->id,'sort'=>'oldest','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'oldest') active @endif">Oldest</a></li>
                                        <li class="filterSort_item"><a wire:navigate href="{{ route('project.profile',['id' => $project->id ,'sort'=>'a_z','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'a_z') active @endif"><i class='bx bx-down-arrow-alt' ></i> A To Z</a></li>
                                        <li class="filterSort_item"><a wire:navigate href="{{ route('project.profile',['id' => $project->id ,'sort'=>'z_a','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'z_a') active @endif"><i class='bx bx-up-arrow-alt' ></i> Z To A</a></li> --}}

                                        <li class="filterSort_item">
                                            <a wire:navigate href="{{ route('project.tasks', ['project' => $project->id, 'sort' => 'newest', 'filter' => $filter ?? null]) }}" class="btn-batch @if($sort == 'newest') active @endif">Newest</a>
                                        </li>
                                        <li class="filterSort_item">
                                            <a wire:navigate href="{{ route('project.tasks', ['project' => $project->id, 'sort' => 'oldest', 'filter' => $filter ?? null]) }}" class="btn-batch @if($sort == 'oldest') active @endif">Oldest</a>
                                        </li>
                                        <li class="filterSort_item">
                                            <a wire:navigate href="{{ route('project.tasks', ['project' => $project->id, 'sort' => 'a_z', 'filter' => $filter ?? null]) }}" class="btn-batch @if($sort == 'a_z') active @endif">
                                                <i class='bx bx-down-arrow-alt'></i> A To Z
                                            </a>
                                        </li>
                                        <li class="filterSort_item">
                                            <a wire:navigate href="{{ route('project.tasks', ['project' => $project->id, 'sort' => 'z_a', 'filter' => $filter ?? null, 'byUser' => $byUser ?? null, 'byTeam' => $byTeam ?? null]) }}" class="btn-batch @if($sort == 'z_a') active @endif">
                                                <i class='bx bx-up-arrow-alt'></i> Z To A
                                            </a>
                                        </li>
                                      
                                    </ul>
                                    <hr>
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <h5 class="filterSort-header mb-0"><i class='bx bx-calendar-alt text-primary'></i> Date</h5>
                                        <div>
                                            <a href="javascript:" class="btn-batch">Start Date</a> <span class="px-2">to</span> <a href="javascript:" class="btn-batch">End Date</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> User</h5>
                                    <select class="form-control" wire:model.live="byUser">
                                        <option value="byUser">All</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <hr>
                                    <h5 class="filterSort-header"><i class='bx bx-sitemap text-primary' ></i> Teams</h5>
                                    <select class="form-control"name="" id="">
                                        <option value="byTeam">All</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
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
                    <a href="javascript:" class="btn-border btn-border-sm btn-border-secondary active"><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('status', 'pending')->where('due_date', '>', now())->count() }} Active</a>
                    <a href="javascript:" class="btn-border btn-border-sm btn-border-danger"><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('due_date', '<', now())->count() }} Overdue</a>
                    <a href="javascript:" class="btn-border btn-border-sm btn-border-success"><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('status', 'completed')->count() }} Completed</a>
                </div>
                </div>
                <div class="col-lg-6 ms-auto text-end">
                    <form class="search-box search-box-float-style" action="">
                        <span class="search-box-float-icon"><i class='bx bx-search'></i></span>
                        <input type="text" class="form-control" placeholder="Search Task...">
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
                    @php
                        $tasks = $project->tasks()->paginate(10)     

                       
                    @endphp
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
                                        @foreach($task->users as $user)
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
            {{  $tasks->links()  }}
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

        
    </script>
@endscript

