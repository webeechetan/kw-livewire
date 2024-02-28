<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('client.index') }}">All Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $client->name }}</li>
        </ol>
    </nav>
    <div class="dashboard-head mb-2">
        <div class="row align-items-center">
            <div class="col">
                <div class="dashboard-head-title-wrap">
                    <div class="client_head_logo"><img src="{{ env('APP_URL') }}/storage/{{ $client->image }}" alt=""></div>
                    <div>
                        <h3 class="main-body-header-title mb-0">{{ $client->name }}</h3>
                        <div class="client_head-date">
                            {{ \Carbon\Carbon::parse($client->onboard_date)->format('d M-Y') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <!-- Edit -->
                    <div class="cus_dropdown">
                        <!-- For Active Class = btn-border-success | For Archived Class = btn-border-archived -->
                        @if(!$client->trashed())
                            <div class="cus_dropdown-icon btn-border btn-border-success">Active <i class='bx bx-chevron-down' ></i></div>
                        @else
                            <div class="cus_dropdown-icon btn-border btn-border-archived">Archived <i class='bx bx-chevron-down' ></i></div>
                        @endif

                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a href="javascript:;" wire:click="changeClientStatus('active')" @if(!$client->trashed()) class="active" @endif>Active</a></li>
                                    <li><a href="javascript:;" wire:click="changeClientStatus('archived')" @if($client->trashed()) class="active" @endif>Archive</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button @if($client->trashed()) disabled @endif wire:click="emitEditClient({{$client->id}})" class="btn-sm btn-border btn-border-secondary "><i class='bx bx-pencil'></i> Edit</button>
                    <a href="#" class="btn-sm btn-border btn-border-danger" wire:click="forceDeleteClient({{$client->id}})"><i class='bx bx-trash'></i> Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div class="tabNavigationBar-tab border_style mb-3">
        <a class="tabNavigationBar-item active" href="{{ route('client.overview', $client->id) }}"><i class='bx bx-line-chart'></i> Overview</a>
        <a class="tabNavigationBar-item" href="{{ route('client.projects', $client->id) }}"><i class='bx bx-layer' ></i> Projects</a>
        <a class="tabNavigationBar-item" href="{{ route('client.file-manager', $client->id ) }}"><i class='bx bx-objects-horizontal-left' ></i> File Manager</a>
    </div>

    <!-- Dashboard Body -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="column-box">
                <div class="states_style states_style-left states_style-progress">
                    <div class="states_style-icon"><i class='bx bx-layer' ></i></div>
                    <div>
                        <h5 class="title-md mb-1">12</h5>
                        <div class="states_style-text">Projects</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="column-box">
                <div class="states_style states_style-left states_style-active">
                    <div class="states_style-icon"><i class='bx bx-sitemap' ></i></div>
                    <div>
                        <h5 class="title-md mb-1">04</h5>
                        <div class="states_style-text">Teams Assigned</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="column-box">
                <div class="states_style states_style-left states_style-success">
                    <div class="states_style-icon"><i class='bx bx-user-plus'></i></div>
                    <div>
                        <h5 class="title-md mb-1">22</h5>
                        <div class="states_style-text">Members Assigned</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="column-box mb-5">
        <div class="row">
            <div class="col-lg-8 pe-lg-5">
                <div class="column-title mb-2">Description</div>
                <hr>
                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
                <h5 class="column-title mt-4">Teams</h5>
                <hr>
                <!-- Teams -->
                <div class="team-list row">
                    @foreach($client->teams as $team)
                        <div class="col-auto">
                            <div class="team team-style_2 editTeam">
                                <!-- Edit -->
                                <div class="cus_dropdown cus_dropdown-edit">
                                    <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                                    <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                        <div class="cus_dropdown-body-wrap">
                                            <ul class="cus_dropdown-list">
                                                <li><a href="#" wire:click="editTeam({{ $team->id }})"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                                <li><a href="#" wire:click="deleteTeam({{ $team->id }})"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-style_2-head_wrap">
                                    <div class="team-avtar">
                                        <span>
                                            <img src="{{ env('APP_URL') }}/storage/{{ $team->image }}" alt="">
                                        </span>
                                    </div>
                                    {{-- <h4 class="team-style_2-title">{{$team->name}} 
                                        <span class="team-style_2-memCount">
                                            @php
                                                $team_user_count = [];
                                                $team_users = $team->users->pluck('id')->toArray();
                                                $client_users = $client->users->pluck('id')->toArray();
                                                foreach($team_users as $team_user){
                                                    if(in_array($team_user, $client_users)){
                                                        $team_user_count[] = $team_user;
                                                    }
                                                }
                                                echo count($team_user_count);
                                                $team_user_count = [];
                                            @endphp
                                            Members
                                        </span>
                                    </h4> --}}
                                    <div>
                                        <h4 class="team-style_2-title">{{$team->name}}</h4>
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Ajay Kumar" data-bs-original-title="Ajay Kumar">
                                                    <img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle">
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Roshan Jajoria" data-bs-original-title="Roshan Jajoria">
                                                    <img alt="avatar" src="http://localhost:8000/storage/images/users/Roshan Jajoria.png" class="rounded-circle">
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Chetan Singh" data-bs-original-title="Chetan Singh">
                                                    <img alt="avatar" src="http://localhost:8000/storage/images/users/Chetan Singh.png" class="rounded-circle">
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 font-500">
                <div class="column-box bg-light mb-2">
                    <div class="row align-items-center">
                        <div class="col"><span><i class='bx bx-layer text-secondary' ></i></span> Created By</div>
                        <div class="col text-secondary">Rakesh Roshan</div>
                    </div>
                </div>
                <div class="column-box bg-light mb-2">
                    <div class="row align-items-center">
                        <div class="col"><span><i class='bx bx-calendar text-success'></i></span> Onboard Date</div>
                        <div class="col text-success">27 Feb, 2024</div>
                    </div>
                </div>
                <div class="column-box bg-light">
                    <div class="row align-items-center">
                        <div class="col"><span><i class='bx bx-user text-primary'></i></span> Point Of Contact</div>
                        <div class="col text-primary">Md. Husain</div>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <!-- All Projects -->
    <div class="col-12 mb-4">
        <div class="column-box h-100">
            <div class="column-head d-flex flex-wrap gap-20 align-items-center mb-4">
                <div>
                    <h5 class="mb-0">All Projects</h5>
                    <div><i class='bx bx-layer text-secondary' ></i> {{ count($client->projects) }} Projects</div>
                </div>
                <div class="ms-auto">
                    <a class="btn-border btn-sm btn-border-secondary" href="#" data-bs-toggle="modal" data-bs-target="#projectModal"><i class="bx bx-plus"></i> Add Project</a>
                </div>
            </div>
            <div class="project-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link project-tabs-active active" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="true">Active</button>
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
    </div>

    <!-- Teams & Folders -->
    <div class="row">
        <div class="col-md-3">
            <div class="column-box h-100">
                <div class="column-head d-flex flex-wrap align-items-center">
                    <div>
                        <h5 class="mb-0">Teams</h5>
                        <div class="text-light">{{ $client->teams->count() }} Teams Assigned</div>
                    </div>
                    <div class="ms-auto">
                        <a class="btn-icon btn-icon-primary" href="#" data-bs-toggle="modal" data-bs-target="#teamModal"><i class="bx bx-plus"></i></a>
                    </div>
                </div>
                <div class="team-scroll scrollbar">
                    <!-- Teams -->
                    <div class="team-list">
                        @foreach($client->teams as $team)
                            <div class="team team-style_2 editTeam">
                                <!-- Edit -->
                                <div class="cus_dropdown cus_dropdown-edit">
                                    <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                                    <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                        <div class="cus_dropdown-body-wrap">
                                            <ul class="cus_dropdown-list">
                                                <li><a href="#" wire:click="editTeam({{ $team->id }})"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                                <li><a href="#" wire:click="deleteTeam({{ $team->id }})"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-style_2-head_wrap">
                                    <div class="team-avtar">
                                        <span>
                                            <img src="{{ env('APP_URL') }}/storage/{{ $team->image }}" alt="">
                                        </span>
                                    </div>
                                    <h4 class="team-style_2-title">{{$team->name}} 
                                        <span class="team-style_2-memCount">
                                            @php
                                                $team_user_count = [];
                                                $team_users = $team->users->pluck('id')->toArray();
                                                $client_users = $client->users->pluck('id')->toArray();
                                                foreach($team_users as $team_user){
                                                    if(in_array($team_user, $client_users)){
                                                        $team_user_count[] = $team_user;
                                                    }
                                                }
                                                echo count($team_user_count);
                                                $team_user_count = [];
                                            @endphp
                                            Members
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <a class="btn btn-sm btn-border-primary w-100" href="#" data-bs-toggle="modal" data-bs-target="#teamModal"><i class="bx bx-plus"></i> Add Team</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <livewire:components.file-manager :client="$client" />
        </div>
    </div>

    <!-- Project Modal -->
    <div wire:ignore class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-layer' ></i></span> <span class="project-modal-title">Add Project</span></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addProject" method="POST" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Project Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="project_name" type="text" class="form-style" placeholder="Project Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Date</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="btn-list btn-list-full-2 justify-content-between gap-10">
                                        <a  class="btn btn-50 btn-sm btn-border-secondary project_start_date"><i class='bx bx-calendar-alt' ></i> Start Date</a>
                                        <a  class="btn btn-50 btn-sm btn-border-danger project_due_date"><i class='bx bx-calendar-alt' ></i> Due Date</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Upload Logo</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="form-file_upload form-file_upload-logo">
                                        <input type="file" id="formFile">
                                        <div class="form-file_upload-box">
                                            <div class="form-file_upload-box-icon"><i class='bx bx-image'></i></div>
                                            <div class="form-file_upload-box-text">Upload Image</div>
                                        </div>
                                        <div class="form-file_upload-valText">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="mb-2">Add Description</label>
                                    <textarea wire:model="project_description" type="text" class="form-style" placeholder="Add Description" rows="2" cols="30"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary project-modal-btn">Add Project</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Modal -->
    <div wire:ignore.self class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-group' ></i></span> Add Team</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit="assignTeam">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Team</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <select class="form-style team_id" wire:model.live="team_id">
                                        <option value="">Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row team_users_col">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Users</label>
                                </div>
                                <div class="col-md-8 mb-4" >
                                    <select class="form-style team_users" class="form-control" multiple wire:model="team_users">
                                        <option value="">Select Users</option>
                                        @foreach($users as $user)
                                            <option data-image="{{ $user->image }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary">Add Team</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Team Modal -->
    <div wire:ignore.self class="modal fade" id="updateTeamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-group' ></i></span> Update Team</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit="updateTeam">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Team</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <select class="form-style team_id" wire:model.live="team_id">
                                        <option value="">Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row team_users_col">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Users</label>
                                </div>
                                <div class="col-md-8 mb-4" >
                                    <select class="form-style team_users" class="form-control" multiple wire:model="team_users">
                                        <option value="">Select Users</option>
                                        @foreach($users as $user)
                                            <option 
                                                @if(in_array($user->id, $team_users))
                                                    selected
                                                @endif
                                            data-image="{{ $user->image }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary">Update Team</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <livewire:components.add-client @saved="$refresh" />

    
    
</div>
@push('scripts')
<script>

    $('.project_start_date').flatpickr({
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            $(".project_start_date").html(dateStr);
            @this.set('project_start_date', dateStr);
        },
    });

    $('.project_due_date').flatpickr({
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            $(".project_due_date").html(dateStr);
            @this.set('project_due_date', dateStr);
        },
    });

    $(document).on('change', '.team_users', function(){
        var selected = $(this).val();
        @this.set('team_users', selected);
        setTimeout(() => {
            $(".team_users").select2({
                placeholder: "Select Users",
                allowClear: true,
                templateResult: format,
                templateSelection: format,
            });
        }, 1000);
    });

    document.addEventListener('teamSelected', event => {
        setTimeout(() => {
            $(".team_users").select2({
                placeholder: "Select Users",
                allowClear: true,
                templateResult: format,
                templateSelection: format,
            });
        }, 100);
    })

    document.addEventListener('teamSelectedForEdit', event => {

        let selected_users_ids = event.detail;

        $("#updateTeamModal").modal('show');

        setTimeout(() => {

            console.log(selected_users_ids);
            $(".team_users").val(selected_users_ids).trigger('change');
        }, 1000);
    })

    document.addEventListener('teamAssigned', event => {
        $("#teamModal").modal('hide');
    });


    document.addEventListener('teamUpdated', event => {
        $("#updateTeamModal").modal('hide');
    });

    document.addEventListener('editProject', event => {
        $("#projectModal").modal('show');
        $(".project-modal-title").html('Edit Project');
        $(".project-modal-btn").html('Update Project');
        if(event.detail[0].due_date){
            $('.project_start_date').flatpickr().setDate(event.detail[0].start_date);
            $(".project_start_date").html(event.detail[0].start_date);
        }
        if(event.detail[0].due_date){
            $('.project_due_date').flatpickr().setDate(event.detail[0].due_date);
            $(".project_due_date").html(event.detail[0].due_date);
        }

    });
    

    function format(state) {
        if (!state.id) {
            return state.text;
        }
        var baseUrl = "{{ env('APP_URL') }}/storage";
        var $state = $(
            '<span><img class="select2-selection__choice__display_userImg" src="' + baseUrl + '/' + state.element.attributes[0].value + '" /> ' + state.text + '</span>'
        );
        return $state;
    };
    
</script>
@endpush
