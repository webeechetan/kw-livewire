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
            <div class="column-box states_style-progress">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="states_style-icon"><i class='bx bx-layer' ></i></div>                        
                    </div>
                    <div class="col">
                        <div class="row align-items-center g-2">
                            <div class="col-auto">
                                <h5 class="title-md mb-0">{{ $active_projects->count() }}</h5>
                            </div>
                            <div class="col-auto">
                                <span class="font-400 text-grey">|</span>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-text">Active</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="column-box states_style-success">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="states_style-icon"><i class='bx bx-layer' ></i></div>                        
                    </div>
                    <div class="col">
                        <div class="row align-items-center g-2">
                            <div class="col-auto">
                                <h5 class="title-md mb-0">{{ $completed_projects->count() }}</h5>
                            </div>
                            <div class="col-auto">
                                <span class="font-400 text-grey">|</span>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-text">Completed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="column-box states_style-danger">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="states_style-icon"><i class='bx bx-layer' ></i></div>                        
                    </div>
                    <div class="col">
                        <div class="row align-items-center g-2">
                            <div class="col-auto">
                                <h5 class="title-md mb-0">{{ $archived_projects->count() }}</h5>
                            </div>
                            <div class="col-auto">
                                <span class="font-400 text-grey">|</span>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-text">Archive</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="column-box mb-3">
        <div class="d-flex flex-wrap gap-20 align-items-center">
            <div>
                <h5 class="mb-0">All Projects <span class="text-light text-md font-400 ms-2">{{ count($client->projects) }} Projects</span></h5>
            </div>
            <div class="ms-auto">
                <a class="btn btn-sm btn-border-primary" href="#" data-bs-toggle="modal" data-bs-target="#add-project-modal"><i class="bx bx-plus"></i> Add Project</a>
            </div>
        </div>
    </div>
    <div class="project-tabs mb-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="project-all-tab" data-bs-toggle="tab" data-bs-target="#project-all-tab-pane" type="button" role="tab" aria-controls="project-all-tab-pane" aria-selected="true">All <span class="ms-2">50</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="true">Active <span class="ms-2">40</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-done-tab" data-bs-toggle="tab" data-bs-target="#project-done-tab-pane" type="button" role="tab" aria-controls="project-done-tab-pane" aria-selected="false">Completed <span class="ms-2">08</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-overdue-tab" data-bs-toggle="tab" data-bs-target="#project-overdue-tab-pane" type="button" role="tab" aria-controls="project-overdue-tab-pane" aria-selected="false">Overdue <span class="ms-2">01</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-archived-tab" data-bs-toggle="tab" data-bs-target="#project-archived-tab-pane" type="button" role="tab" aria-controls="project-archived-tab-pane" aria-selected="false">Archive <span class="ms-2">02</span></button>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="project-active-tab-pane" role="tabpanel" aria-labelledby="project-active-tab" tabindex="0">
            <div class="project-list">
                <!-- project-overdue, project-success, project-warning -->
                @foreach($active_projects as $project)
                    <div class="project project-align_left">
                        <div class="project-icon"><i class='bx bx-layer'></i></div>
                        <div class="project-content">
                            <a href="#" class="project-title">{{ $project->name }}</a>
                            @if($project->due_date)
                                <div class="project-selected-date">Due on <span>{{ $project->due_date }}</span></div>
                            @else
                                <div class="project-selected-date">Due on <span>No Due Date</span></div>
                            @endif
                        </div>
                        <a href="{{ route('client.profile', $client->id ) }}" class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                        <!-- Edit -->
                        <div class="cus_dropdown cus_dropdown-edit">
                            <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                            <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                <div class="cus_dropdown-body-wrap">
                                    <ul class="cus_dropdown-list">
                                        <li><a href="#" wire:click="emitEditEvent({{ $project->id }})"><span><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                        <li wire:click="emitDeleteEvent({{ $project->id }})"><a href="javascript:;"><span><i class='bx bx-trash' ></i></span> Delete</a></li>
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
    <!-- Add Project Modal -->
    <livewire:components.add-project @saved="$refresh" />
</div>
