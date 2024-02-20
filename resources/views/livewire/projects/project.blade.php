<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
        </ol>
    </nav>
    <div class="dashboard-head mb-4">
        <div class="row align-items-center">
            <div class="col">
                <div class="dashboard-head-title-wrap">
                    <div class="client_head_logo"><img src="{{ asset('storage/'.$project->image) }}" alt=""></div>
                    <div>
                        <h3 class="main-body-header-title mb-0">{{ $project->name }}</h3>
                        <div class="client_head-date">{{ \Carbon\Carbon::parse($project->start_date)->format('d M-Y') }}</div>
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
                                    <li><a href="#" class="active"><span><i class='bx bx-user-check' ></i></span> Active</a></li>
                                    <li><a href="#"><span><i class='bx bx-user-minus' ></i></span> Archived</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn-sm btn-border btn-border-secondary"><i class='bx bx-pencil'></i> Edit</a>
                    <a href="#" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Body -->
    <div class="row">
        <div class="col-md-4">
            <div class="column-box">
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar text-success'></i></span> Duration</div>
                    <div class="col">{{ \Carbon\Carbon::parse($project->due_date)->diffInDays($project->start_date)}} Days</div>
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
                <hr>
                <div class="row align-items-center mb-3">
                    <div class="col"><span><i class='bx bx-user text-primary' ></i></span> Assigness</div>
                    <div class="col">
                        <!-- Avatar Group -->
                        <div class="avatarGroup avatarGroup-lg avatarGroup-overlap">
                            @php
                                $usersCount = $project->users->count();  
                            @endphp
                            @foreach($project->users as $user)
                                @if($loop->index > 2)
                                    @break
                                @endif
                                <a href="#" class="avatarGroup-avatar">
                                    <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                        <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle">
                                    </span>
                                </a>
                            @endforeach
                            @if($usersCount > 3)
                                <a href="#" class="avatarGroup-avatar">
                                    <span class="avatar avatar-sm">
                                        <div class="avatar avatar-sm avatar-more">+{{ $usersCount - 3 }}</div>
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col"><span><i class='bx bx-layer text-primary'></i></span> Attachements</div>
                    <div class="col">
                        <div class="d-flex align-items-center flex-wrap"><span class="text-primary d-flex"><i class='bx bx-folder me-1' ></i></span> 2 <span class="px-2">|</span> <span class="text-secondary d-flex"><i class='bx bx-file-blank me-1' ></i></span>4 <a href="#" class="ms-3 btn_link btn_link-border btn_link-sm">Add</a></div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="d-flex flex-wrap align-items-start">
                        <div class="title-label">Teams</div>
                        <a href="#" class="btn-border btn-border-sm ms-auto"><i class='bx bx-plus' ></i> Add</a>
                    </div>
                    <div class="btn-list">
                        <a href="#" class="btn-batch"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                        <a href="#" class="btn-batch"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                        <a href="#" class="btn-batch"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                    </div>
                </div>
                <hr>
                <div class="task_progress">
                    <div class="task_progress-head">
                        <div class="task_progress-head-title">Progress</div>
                        <div class="task_progress-head-days"><span><i class='bx bx-calendar-minus'></i></span> 45 Days Left</div>
                    </div>
                    <div class="task_progress-btm">
                        <div class="progress" role="progressbar" aria-label="Project Progress" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-success" style="width: 60%"><span class="progress-bar-text">60%</span></div>
                        </div>
                        <div class="task_progress-btm-date d-flex justify-content-between">
                            <div><i class='bx bx-calendar text-primary' ></i> 26 Jan 2024</div>
                            <div class="text-success"><i class='bx bx-calendar-check ' ></i> 30 March 2024</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="title-label d-flex align-items-center">Description <a href="#" class="ms-2 d-inline-flex"><i class='bx bx-pencil text-primary'></i></a></div>
                <div class="text-sm">The female circus horse-rider is a recurring subject in Chagall’s work. In 1926 the art dealer Ambroise Vollard invited Chagall to make a project based on the circus. They visited Paris’s historic Cirque d’Hiver Bouglione together; Vollard lent Chagall his private box seats. Chagall completed 19 gou... <a href="#" class="btn_link btn_link-primary">see more</a></div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="column-box">
                <div class="d-flex flex-wrap justify-content-between">
                    <div><h4 class="column-title mb-0"><i class='bx bx-objects-horizontal-left text-primary' ></i> 60 Tasks</h4></div>
                    <div><a href="#" class="btn-sm btn-border"><i class='bx bx-plus' ></i> Add Task</a></div>
                </div>
                <hr class="space-sm">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                    <div class="btn-list">
                        <a href="#" class="btn-border btn-border-sm btn-border-secondary active"><span><i class='bx bx-objects-horizontal-center' ></i></span> 30 Active</a>
                        <a href="#" class="btn-border btn-border-sm btn-border-danger"><span><i class='bx bx-objects-horizontal-center' ></i></span> 20 Overdue</a>
                        <a href="#" class="btn-border btn-border-sm btn-border-success"><span><i class='bx bx-objects-horizontal-center' ></i></span> 10 Completed</a>
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
                            <div class="taskList-dashbaord_header_title taskList_col">Task Name</div>
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
                <div class="taskList">
                    <div class="taskList_row">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="taskList_col taskList_col_title">
                                    <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                    <div>
                                        <div>Acma Website Backup</div>
                                        <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="taskList_col">
                                    <div class="avatarGroup avatarGroup-overlap">
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="taskList_col">
                                    <div class="avatarGroup avatarGroup-overlap">
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">                                    
                                <div class="icon_group justify-content-center">
                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="taskList_row">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="taskList_col taskList_col_title">
                                    <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                    <div>
                                        <div>Acma Website Backup</div>
                                        <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="taskList_col">
                                    <div class="avatarGroup avatarGroup-overlap">
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="taskList_col">
                                    <div class="avatarGroup avatarGroup-overlap">
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">                                    
                                <div class="icon_group justify-content-center">
                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="taskList_row">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="taskList_col taskList_col_title">
                                    <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                    <div>
                                        <div>Acma Website Backup</div>
                                        <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="taskList_col">
                                    <div class="avatarGroup avatarGroup-overlap">
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="taskList_col">
                                    <div class="avatarGroup avatarGroup-overlap">
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Assigned: Chetan Kumar">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">                                    
                                <div class="icon_group justify-content-center">
                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 d-none">
            <div class="column-box h-100">
                <div class="column-head d-flex flex-wrap align-items-center">
                    <div>
                        <h5 class="mb-0">Teams</h5>
                        <div class="text-light">03 Teams Assigned</div>
                    </div>
                    <div class="ms-auto">
                        <a class="btn-icon btn-icon-primary" href="#" data-bs-toggle="modal" data-bs-target="#teamModal"><i class="bx bx-plus"></i></a>
                    </div>
                </div>
                <div class="team-scroll scrollbar">
                    <!-- Teams -->
                    <div class="team-list">
                        <div class="team team-style_2 editTeam">
                            <!-- Edit -->
                            <div class="cus_dropdown cus_dropdown-edit">
                                <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                                <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                    <div class="cus_dropdown-body-wrap">
                                        <ul class="cus_dropdown-list">
                                            <li><a href="#"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                            <li><a href="#"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="team-style_2-head_wrap">
                                <div class="team-avtar">
                                    <span>
                                        <img src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" alt="">
                                    </span>
                                </div>
                                <h4 class="team-style_2-title">Tech Team
                                    <span class="team-style_2-memCount"></span>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <a class="btn btn-sm btn-border-primary w-100" href="#" data-bs-toggle="modal" data-bs-target="#teamModal"><i class="bx bx-plus"></i> Add Team</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
        </div>
    </div>
</div>
@script
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
    </script>
@endscript
