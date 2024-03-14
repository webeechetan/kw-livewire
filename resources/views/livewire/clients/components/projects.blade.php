<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('client.index') }}">All Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$client->name}}</li>
        </ol>
    </nav>

    <livewire:clients.components.client-tabs :client="$client" @saved="$refresh" />

    <!-- Dashboard Body -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="column-box">
                <div class="states_style states_style-left states_style-progress">
                    <div class="states_style-icon"><i class='bx bx-layer' ></i></div>
                    <div>
                        <h5 class="title-md mb-1">{{ $active_projects->count() }}</h5>
                        <div class="states_style-text">Active</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="column-box">
                <div class="states_style states_style-left states_style-success">
                    <div class="states_style-icon"><i class='bx bx-layer' ></i></div>
                    <div>
                        <h5 class="title-md mb-1">{{ $completed_projects->count() }}</h5>
                        <div class="states_style-text">Completed</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="column-box">
                <div class="states_style states_style-left states_style-danger">
                    <div class="states_style-icon"><i class='bx bx-layer'></i></div>
                    <div>
                        <h5 class="title-md mb-1">{{ $archived_projects->count() }}</h5>
                        <div class="states_style-text">Archive</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="column-box mb-4">
        <div class="d-flex flex-wrap gap-20 align-items-center">
            <div>
                <h5 class="mb-0">All Projects <span class="text-light text-md font-400 ms-2">{{ count($client->projects) }} Projects</span></h5>
            </div>
            <div class="ms-auto">
                <a class="btn btn-sm btn-border-primary" href="#" data-bs-toggle="modal" data-bs-target="#add-project-modal"><i class="bx bx-plus"></i> Add Project</a>
            </div>
        </div>
        <hr>
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
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="project-active-tab-pane" role="tabpanel" aria-labelledby="project-active-tab" tabindex="0">
            <div class="project-list">
                @foreach($active_projects as $project)
                    <div class="project project-align_left project-overdue">
                        <div class="project-icon">
                            <span class="d-inline-flex"><i class='bx bx-layer'></i></span>
                        </div>
                        <div class="project-content">
                            <a wire:navigate href="{{ route('project.profile',$project->id) }}" class="project-title">{{ $project->name }}</a>
                            @if($project->due_date)
                                <div class="project-selected-date">Due on <span>{{ $project->due_date }}</span></div>
                            @else
                                <div class="project-selected-date">Due on <span>No Due Date</span></div>
                            @endif
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
                        <a wire:navigate href="{{ route('project.profile',$project->id) }}" class="project-title">{{ $project->name }}</a>
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
                            <a wire:navigate href="{{ route('project.profile',$project->id) }}" class="project-title">{{ $project->name }}</a>
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
                        <a wire:navigate href="{{ route('project.profile',$project->id) }}" class="project-title">{{ $project->name }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Add Project Modal -->
    <livewire:components.add-project @saved="$refresh" />
</div>
