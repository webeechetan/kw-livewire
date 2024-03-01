<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
        </ol>
    </nav>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col">
                <div class="dashboard-head-title-wrap">
                    <div class="client_head_logo"><img src="{{ asset('storage/'.$project->image) }}" alt=""></div>
                    <div>
                        <div class="client_head-date">{{ \Carbon\Carbon::parse($project->start_date)->format('d M-Y') }}</div>
                        <h3 class="main-body-header-title mb-0">{{ $project->name }}</h3>
                    </div>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <!-- Edit -->
                    <div class="cus_dropdown">
                        <!-- For Active Class = btn-border-success | For Archived Class = btn-border-archived -->
                        <div class="cus_dropdown-icon btn-border btn-border-success">Active <i class='bx bx-chevron-down' ></i></div>
                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a href="javascript:" class="active"><span><i class='bx bx-user-check' ></i></span> Active</a></li>
                                    <li><a href="javascript:"><span><i class='bx bx-user-minus' ></i></span> Archived</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:" wire:click="emitEditProjectEvent({{ $project->id }})" class="btn-sm btn-border btn-border-secondary"><i class='bx bx-pencil'></i> Edit</a>
                    <a href="javascript:" wire:click.confirm="emitDeleteProjectEvent({{ $project->id }})" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="tabNavigationBar-tab border_style mb-3">
        <a class="tabNavigationBar-item active" href="#"><i class='bx bx-line-chart'></i> Overview</a>
        <a class="tabNavigationBar-item" href="#"><i class='bx bx-layer' ></i> Tasks</a>
        <a class="tabNavigationBar-item" href="#"><i class='bx bx-objects-horizontal-left' ></i> File Manager</a>
    </div>

    <!-- Dashboard Body -->
    <div class="row">
        <div class="col-md-4">
            <div class="column-box">
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-layer text-success' ></i></span> Created By</div>
                    <div class="col">Rakesh Roshan</div>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar-alt text-primary'></i></span> Start Date</div>
                    <div class="col">26 April 2024 <a href="javascript:" class="ms-2"><i class='bx bx-pencil text-primary'></i></a></div>                    
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar text-primary'></i></span> Due Date</div>
                    <div class="col project-due-date">
                        @if($project->due_date)
                            {{ \Carbon\Carbon::parse($project->due_date)->format('d M-Y') }} 
                        @else
                            <span class="text-danger">Not Set</span>
                        @endif

                        <a href="javascript:" class="ms-2 change-due-date" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Date">
                            <i class='bx bx-pencil text-primary'></i>
                        </a>
                    </div>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar text-success'></i></span> Duration</div>
                    <div class="col">{{ \Carbon\Carbon::parse($project->due_date)->diffInDays($project->start_date)}} Days</div>
                </div>
                <hr>
                <div class="row align-items-center mb-3">
                    <div class="col"><span><i class='bx bx-user text-primary' ></i></span> Assigness</div>
                    <div class="col">
                        <div class="assign-new-user-col d-none">
                            <select class="users" name="" id="" multiple>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option 
                                        @if($project->users->contains($user->id))
                                            @selected(true)
                                        @endif
                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="javascript:" class="btn_link btn_link-border btn_link-sm assign-new-user">Add</a>
                        <!-- Avatar Group -->
                        <div class="avatarGroup avatarGroup-lg avatarGroup-overlap">
                            @php
                                $usersCount = $project->users->count();  
                            @endphp
                            @foreach($project->users as $user)
                                @if($loop->index > 2)
                                    @break
                                @endif
                                <a href="javascript:" class="avatarGroup-avatar" wire-key="project-user-{{$user->id}}">
                                    <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                        <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle">
                                    </span>
                                </a>
                            @endforeach
                            @if($usersCount > 3)
                                <a href="javascript:" class="avatarGroup-avatar" wire-key="project-user-more">
                                    <span class="avatar avatar-sm">
                                       +{{ $usersCount - 3 }}
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col"><span><i class='bx bx-layer text-primary'></i></span> Attachements</div>
                    <div class="col">
                        <div class="d-flex align-items-center flex-wrap"><span class="text-primary d-flex"><i class='bx bx-folder me-1' ></i></span> 2 <span class="px-2">|</span> <span class="text-secondary d-flex"><i class='bx bx-file-blank me-1' ></i></span>4 <a href="javascript:" class="ms-3 btn_link btn_link-border btn_link-sm">Add</a></div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="title-label">Teams</div>
                    <div class="btn-list">
                        <a href="javascript:" class="btn-batch btn-batch-profile"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                        <a href="javascript:" class="btn-batch btn-batch-profile"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                        <a href="javascript:" class="btn-batch btn-batch-profile"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                    </div>
                </div>
                <hr>
                <div class="task_progress">
                    <div class="task_progress-head">
                        <div class="task_progress-head-title">Progress</div>
                        <div class="task_progress-head-days"><span><i class='bx bx-calendar-minus'></i></span> 
                            {{ \Carbon\Carbon::parse($project->due_date)->diffInDays($project->start_date) }} Days Left</div>
                    </div>
                    @php
                    $progress = 0;
                    if($project->tasks->count() > 0){
                        $progress = ($project->tasks->where('status', 'completed')->count() / $project->tasks->count()) * 100;
                    }

                    @endphp
                    <div class="task_progress-btm">
                        <div class="progress" role="progressbar" aria-label="Project Progress" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-success" style="width: {{$progress}}%"><span class="progress-bar-text">{{  round($progress)}}%</span></div>
                        </div>
                        <div class="task_progress-btm-date d-flex justify-content-between">
                            <div><i class='bx bx-calendar text-primary' ></i> {{ \Carbon\Carbon::parse($project->start_date)->format('d M-Y') }}</div>
                            <div class="text-success"><i class='bx bx-calendar-check ' ></i> {{ \Carbon\Carbon::parse($project->due_date)->format('d M-Y') }}</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div wire:ignore class="project-description-container">

                    <div class="title-label d-flex align-items-center">Description <a href="javascript:" class="ms-2 d-inline-flex edit-description"><i class='bx bx-pencil text-primary'></i></a></div>
                    <div class="text-sm project-description txtarea">
                        {!! $project->description !!}
                    </div>
                </div>
                {{-- <a href="javascript:" class="btn_link btn_link-primary">see more</a> --}}
            </div>
        </div>
        <div class="col-md-8">
            <div class="column-box h-100">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div><h4 class="column-title mb-0"><i class='bx bx-objects-horizontal-left text-primary' ></i> {{ $project->tasks->count() }} Tasks</h4></div>
                    <div class="btn-list">
                        <a href="javascript:;" class="btn-sm btn-border" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class='bx bx-plus' ></i> Add Task</a>
                        <div class="cus_dropdown">
                            <div class="cus_dropdown-icon btn-border btn-border-secondary"><i class='bx bx-filter-alt' ></i> Filter</div>
                            <div class="cus_dropdown-body cus_dropdown-body-widh_l">
                                <div class="cus_dropdown-body-wrap">
                                    <div class="filterSort">
                                        <h5 class="filterSort-header"><i class='bx bx-sort-down text-primary' ></i> Sort By</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.profile',['id' => $project->id ,'sort'=>'newest','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'newest') active @endif">Newest</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.profile',['id' => $project->id,'sort'=>'oldest','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'oldest') active @endif">Oldest</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.profile',['id' => $project->id ,'sort'=>'a_z','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'a_z') active @endif"><i class='bx bx-down-arrow-alt' ></i> A To Z</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.profile',['id' => $project->id ,'sort'=>'z_a','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'z_a') active @endif"><i class='bx bx-up-arrow-alt' ></i> Z To A</a></li>
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
                                            <option value="Rakesh">Rakesh</option>
                                            <option value="Rajiv">Rajiv</option>
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
                        <a href="javascript:" class="btn-border btn-border-sm btn-border-secondary active"><span><i class='bx bx-objects-horizontal-center' ></i></span> {{ $project->tasks->where('status', 'assigned')->count() }} Active</a>
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
                        <div class="col-lg-6">
                            <div class="taskList-dashbaord_header_title taskList_col ms-2">Task Name</div>
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
                <div class="taskList scrollbar">
                    <div>
                        @foreach($project->tasks as $task)
                        <div class="taskList_row" wire:key="task-row-{{ $task->id }}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>{{ $task->name }}</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 
                                                {{ \Carbon\Carbon::parse($task->due_date)->format('d M-Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            @foreach($task->users as $user)
                                                <a href="javascript:" wire-key="task-user-{{$user->id}}" class="avatarGroup-avatar">
                                                    <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                        <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle" />
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            @foreach($task->notifiers as $user)
                                                <a href="javascript:" class="avatarGroup-avatar" wire-key="task-notifier-{{$user->id}}">
                                                    <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                        <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle" />
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit edit-task" data-id="{{ $task->id }}" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a wire:click="deleteTask({{ $task->id }})" class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
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
    
    <livewire:components.add-task @saved="$refresh" :project="$project" wire:key="task-{{$project->id}}"  />
    <livewire:components.add-project @saved="$refresh" wire:key="project-{{$project->id}}" />
    
</div>
@push('scripts')
    
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    flatpickr(".change-due-date", {
        dateFormat: "Y-m-d",
        defaultDate: "{{ $project->due_date }}",
        onChange: function(selectedDates, dateStr, instance) {
            $(".project-due-date").html(dateStr);
            @this.changeDueDate(dateStr);
        }
    });

    $(".edit-description").click(function(){
        $(".project-description").summernote({
            height: 200,
            toolbar: [
                ['font', ['bold', 'underline']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['fm-button', ['fm']],
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.updateDescription(contents);
                }
            },
        });
    });

    // destroy summernote when clicked outside

    $(document).on("click", function(event) {
        let l = $(event.target).closest(".project-description-container").length
        if(!l){
            $(".project-description").summernote('destroy')
        }
        
    });

    $(".users").select2({
        placeholder: "Select User",
        allowClear: true
    });
    
    $(".assign-new-user").click(function(){
        $(".assign-new-user-col").toggleClass("d-none");
        $(".users").select2({
            placeholder: "Select User",
            allowClear: true
        });
    });

    $(".users").change(function(){
        var users = $(this).val();
        console.log(users);
        @this.syncUsers(users);
    });

    // user-synced
    document.addEventListener('user-synced', event => {
        $(".users").select2({
            placeholder: "Select User",
            allowClear: true
        });
    });

    // edit-task

    $(".edit-task").click(function(){
        let taskId = $(this).data('id');
        @this.emitEditTaskEvent(taskId);
    });

    // $(document).ready(function(){
    //     $("#comment_box").summernote({
    //         height: 100,
    //         toolbar: [
    //             ['font', ['bold', 'underline']],
    //             ['para', ['ul', 'ol']],
    //             ['insert', ['link']],
    //             ['fm-button', ['fm']],
    //         ]
    //     });
    // });
    
</script>
@endpush
