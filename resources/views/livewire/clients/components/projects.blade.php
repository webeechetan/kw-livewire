<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('client.index') }}">All Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">Acma</li>
        </ol>
    </nav>
    <div class="dashboard-head mb-3">
        <div class="row align-items-center">
            <div class="col">
                <div class="dashboard-head-title-wrap">
                    <div class="client_head_logo"><img src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" alt=""></div>
                    <div>
                        <h3 class="main-body-header-title mb-0">Acma</h3>
                        <div class="client_head-date">
                            27 Feb-2024
                        </div>
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
                                    <li><a href="#"class="active"><span><i class='bx bx-user-check' ></i></span> Active</a></li>
                                    <li><a href="#"><span><i class='bx bx-user-minus' ></i></span> Archived</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button class="btn-sm btn-border btn-border-secondary "><i class='bx bx-pencil'></i> Edit</button>
                    <a href="#" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div class="tabNavigationBar-tab border_style mb-3">
        <a class="tabNavigationBar-item" href="#"><i class='bx bx-line-chart'></i> Overview</a>
        <a class="tabNavigationBar-item active" href="#"><i class='bx bx-layer' ></i> Projects</a>
        <a class="tabNavigationBar-item" href="#"><i class='bx bx-objects-horizontal-left' ></i> File Manager</a>
    </div>

    <!-- Dashboard Body -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="column-box">
                <div class="states_style states_style-left states_style-progress">
                    <div class="states_style-icon"><i class='bx bx-layer' ></i></div>
                    <div>
                        <h5 class="title-md mb-1">06</h5>
                        <div class="states_style-text">Active</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="column-box">
                <div class="states_style states_style-left states_style-success">
                    <div class="states_style-icon"><i class='bx bx-sitemap' ></i></div>
                    <div>
                        <h5 class="title-md mb-1">04</h5>
                        <div class="states_style-text">Completed</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="column-box">
                <div class="states_style states_style-left states_style-danger">
                    <div class="states_style-icon"><i class='bx bx-user-plus'></i></div>
                    <div>
                        <h5 class="title-md mb-1">22</h5>
                        <div class="states_style-text">02 Archive</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="column-box">
        <div class="row">
            {{-- <div class="col-12 mb-4">
                <div class="column-box h-100">
                    <div class="column-head d-flex flex-wrap gap-20 align-items-center mb-4">
                        <div>
                            <h5 class="mb-0">All Projects</h5>
                            <div class="text-light">{{ count($client->projects) }} Projects</div>
                        </div>
                        <div class="ms-auto">
                            <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#projectModal"><i class="bx bx-plus"></i> Add Project</a>
                        </div>
                    </div>
                    <div class="project-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="true">Active</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link project-tabs-completed" id="project-done-tab" data-bs-toggle="tab" data-bs-target="#project-done-tab-pane" type="button" role="tab" aria-controls="project-done-tab-pane" aria-selected="false">Completed</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link project-tabs-overdue" id="project-overdue-tab" data-bs-toggle="tab" data-bs-target="#project-overdue-tab-pane" type="button" role="tab" aria-controls="project-overdue-tab-pane" aria-selected="false">Overdue</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link project-tabs-archived" id="project-archived-tab" data-bs-toggle="tab" data-bs-target="#project-archived-tab-pane" type="button" role="tab" aria-controls="project-archived-tab-pane" aria-selected="false">Archived</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="project-active-tab-pane" role="tabpanel" aria-labelledby="project-active-tab" tabindex="0">
                            <div class="project-list">
                                @foreach($active_projects as $project)
                                    <div class="project project-align_left project-overdue">
                                        <div class="project-icon">
                                            <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                        </div>
                                        <div class="project-content">
                                            <a href="#" class="project-title">{{ $project->name }}</a>
                                            @if($project->due_date)
                                                <div class="project-selected-date">Due on <span>{{ $project->due_date }}</span></div>
                                            @else
                                                <div class="project-selected-date">Due on <span>No Due Date</span></div>
                                            @endif
                                        </div>
                                        <!-- Edit -->
                                        <div class="cus_dropdown cus_dropdown-edit">
                                            <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                                            <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                                <div class="cus_dropdown-body-wrap">
                                                    <ul class="cus_dropdown-list">
                                                        <li><a href="#" wire:click="editProject({{ $project->id }})"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                                        <li><a href="#"><span wire:click="deleteProject({{ $project->id }})" class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="project-done-tab-pane" role="tabpanel" aria-labelledby="project-done-tab" tabindex="0">
                            <div class="project-list project-list-completed">
                                @foreach($completed_projects as $project)
                                <div class="project project-align_left">
                                    <div class="project-icon">
                                        <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                    </div>
                                    <div class="project-content">
                                        <a href="#" class="project-title">{{ $project->name }}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="project-overdue-tab-pane" role="tabpanel" aria-labelledby="project-overdue-tab" tabindex="0">
                            <div class="project-list project-list-overdue">
                                @foreach($overdue_projects as $project)
                                    <div class="project project-align_left">
                                        <div class="project-icon">
                                            <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                        </div>
                                        <div class="project-content">
                                            <a href="#" class="project-title">{{ $project->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="project-archived-tab-pane" role="tabpanel" aria-labelledby="project-archived-tab" tabindex="0">
                            <div class="project-list project-list-archive">
                                @foreach($archived_projects as $project)
                                <div class="project project-align_left">
                                    <div class="project-icon">
                                        <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                    </div>
                                    <div class="project-content">
                                        <a href="#" class="project-title">{{ $project->name }}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
