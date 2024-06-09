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
                                <h5 class="title-md mb-0">{{ $projects->where('status','active')->count() }}</h5>
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
                                <h5 class="title-md mb-0">{{ $projects->where('status','completed')->count() }}</h5>
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
                                <h5 class="title-md mb-0">{{ $projects->where('deleted_at','NOT NULL')->count() }}</h5>
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
            @can('Create Project')
            <div class="ms-auto">
                <a class="btn btn-sm btn-border-primary" href="#" data-bs-toggle="modal" data-bs-target="#add-project-modal"><i class="bx bx-plus"></i> Add Project</a>
            </div>
            @endcan
        </div>
    </div>
    <div class="dashboard_filters d-flex flex-wrap gap-4 align-items-center mb-4">
        <a class="@if($filter == 'all') active @endif" wire:click="$set('filter','all')">All <span class="btn-batch">{{ $projects->count() }}</span></a>
        <a class="@if($filter == 'active') active @endif" wire:click="$set('filter','active')">Active <span class="btn-batch">{{ $projects->where('status','active')->count() }}</span></a>
        <a class="@if($filter == 'overdue') active @endif" wire:click="$set('filter','overdue')">Overdue <span class="btn-batch">
            {{ $projects->where('due_date','<',now())->count() }}
        </span></a>
        <a class="@if($filter == 'completed') active @endif" wire:click="$set('filter','completed')">Completed <span class="btn-batch">{{ $projects->where('status','completed')->count() }}</span></a>
        <a class="@if($filter == 'archived') active @endif" wire:click="$set('filter','archived')">Archive <span class="btn-batch">{{ $projects->where('deleted_at','NOT NULL')->count() }}</span></a>
    </div>

    <div class="project-list">
        @if($projects->isNotEmpty())
            @foreach($projects as $project)
                <div class="project project-align_left">
                    <div class="project-icon"><i class='bx bx-layer'></i></div>
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
        @endif
    </div>
    <!-- Add Project Modal -->
    <livewire:components.add-project @saved="$refresh" />
</div>
