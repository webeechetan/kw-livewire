<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Projects</li>
        </ol>
    </nav>

    <div class="dashboard-head mb-3">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0 @if($filter == 'archived') archived_content @endif">All Projects</h3>
                @can('Create Project')
                    <span class="text-light">|</span>
                    <a data-bs-toggle="modal" data-bs-target="#add-project-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Project</a>
                @endcan
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Projects...">
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
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>'newest','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'newest') active @endif">Newest</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>'oldest','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'oldest') active @endif">Oldest</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>'a_z','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'a_z') active @endif"><i class='bx bx-down-arrow-alt' ></i> A To Z</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>'z_a','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($sort == 'z_a') active @endif"><i class='bx bx-up-arrow-alt' ></i> Z To A</a></li>
                                        </ul>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-briefcase text-primary' ></i> Filter By Status</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'all']) }}" class="btn-batch @if($filter == 'all') active @endif">All</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'active','byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($filter == 'active') active @endif">Active</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'overdue','byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($filter == 'overdue') active @endif">Overdue</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'completed','byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($filter == 'completed') active @endif">Completed</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'archived','byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($filter == 'archived') active @endif">Archived</a></li>
                                        </ul>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-briefcase text-primary' ></i> Filter By Client</h5>
                                        <select class="dashboard_filters-select w-100" wire:model.live="byClient" name="" id="">
                                            <option value="all">All</option>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id}}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By User</h5>
                                        <select class="dashboard_filters-select w-100" wire:model.live="byUser">
                                            <option value="all">All</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <h5 class="filterSort-header mt-4"><i class='bx bx-briefcase text-primary' ></i> Filter By Teams</h5>
                                        <select class="dashboard_filters-select w-100" wire:model.live="byTeam" name="" id="">
                                            <option value="all">All</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id}}">{{ $team->name }}</option>
                                            @endforeach
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
    
    <div class="row">
        <div class="col-md-6">
            <div class="dashboard_filters d-flex flex-wrap gap-4 align-items-center mb-4">
                <a class="@if($filter == 'all') active @endif" wire:navigate href="{{ route('project.index') }}">All <span class="btn-batch">{{$allProjects}}</span></a>
                <a class="@if($filter == 'active') active @endif" wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'active']) }}">Active <span class="btn-batch">{{$activeProjects}}</span></a>
                <a class="@if($filter == 'overdue') active @endif" wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'overdue']) }}">Overdue <span class="btn-batch">{{$overdueProjects}}</span></a>
                <a class="@if($filter == 'completed') active @endif" wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'completed']) }}">Completed <span class="btn-batch">{{$completedProjects}}</span></a>
                <a class="@if($filter == 'archived') active @endif" wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'archived']) }}">Archive <span class="btn-batch">{{$archivedProjects}}</span></a>
            </div> 
        </div>
        <div class="col-md-6">
            @if($this->doesAnyFilterApplied())
            <x-filters-query-params 
                :sort="$sort" 
                :status="$filter" 
                :byUser="$byUser" 
                :byClient="$byClient"
                :users="$users" 
                :teams="$teams"
                :clients="$clients"
                :clearFilters="project.index')"
            />
            @endif
        </div>
  
        @if($projects->isNotEmpty())
            @foreach($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card_style h-100">
                        <a href="{{ route('project.profile', $project->id ) }}" class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                        <div class="card_style-project-head">
                            <div class="card_style-project-head-client"><span><i class='bx bx-briefcase-alt-2'></i></span> {{ $project->client?->name }}</div>
                            <h4><a href="{{ route('project.profile',$project->id) }}" wire:navigate>{{ $project->name }}</a></h4>
                            <!-- Avatar Group -->
                            <div class="avatarGroup avatarGroup-lg avatarGroup-overlap mt-2">
                                @php
                                    $plus_more_users = 0;
                                    if(count($project->members) > 7){
                                        $plus_more_users = count($project->members) - 7;
                                    }
                                @endphp

                                @foreach($project->members->take(7) as $user)
                                   <x-avatar :user="$user" />
                                @endforeach
                                @if($plus_more_users)
                                <a href="#" class="avatarGroup-avatar">
                                    <span class="avatar avatar-sm avatar-more">+{{$plus_more_users}}</span>
                                </a>
                            @endif
                                
                            </div>
                        </div>
                        <!-- User this class for overdue (card_style-overdue) -->
                        <div class="card_style-project-body mt-3">
                            {{-- <div class="card_style-project-options">
                                <div><span><i class='bx bx-layer' ></i></span> 5 Attachments</div>
                                <div><span><i class='bx bx-calendar' ></i></span> {{ \Carbon\Carbon::parse($project->due_date)->diffInDays($project->start_date) }} Days</div>
                            </div> --}}
                            <div class="card_style-tasks">
                                <div class="card_style-tasks-title mb-2"><span><i class='bx bx-objects-horizontal-left' ></i></span> {{ $project->tasks->count() }} {{ $project->tasks->count() >1 ? 'Tasks' : 'Task' }} </div>
                                <div class="card_style-tasks-list">
                                    <div class="card_style-tasks-item card_style-tasks-item-pending"><span><i class='bx bx-objects-horizontal-center' ></i></span>
                                        {{ $project->tasks->where('status', 'pending')->where('due_date', '>', now())->count() }} Active
                                    </div>
                                    <div class="card_style-tasks-item card_style-tasks-item-overdue"><span><i class='bx bx-objects-horizontal-center' ></i></span> 
                                        {{ $project->tasks->where('due_date', '<', now())->count() }} Overdue
                                    </div>
                                    <div class="card_style-tasks-item card_style-tasks-item-done"><span><i class='bx bx-objects-horizontal-center' ></i></span>
                                        {{ $project->tasks->where('status', 'completed')->count() }} Completed
                                    </div>
                                </div>
                            </div>
                            <div class="task_progress mt-3">
                                <div class="task_progress-head">
                                    <div class="task_progress-head-title">Progress</div>
                                    <div class="task_progress-head-days"><span><i class='bx bx-calendar-minus'></i></span> 
                                        @php
                                            $days = \Carbon\Carbon::parse($project->due_date)->diffInDays(now());
                                        @endphp
                                        @if($days > 0 && $project->due_date > now())
                                            {{ $days }} Days Left
                                        @elseif($days == 0)
                                            Today
                                        @else
                                            {{ abs($days) }} Days Overdue
                                        @endif
                                    </div>
                                </div>
                                <div class="task_progress-btm">
                                    <div class="progress w-100" role="progressbar" aria-label="Project Progress" aria-valuemin="0" aria-valuemax="100">
                                        <!-- @php
                                            $percentage = 0;
                                            $completed = $project->tasks->where('status', 'completed')->count();
                                            $total = $project->tasks->count();
                                            if($total > 0){
                                                $percentage = ($completed / $total) * 100;  
                                            }else{
                                                $percentage = 0;
                                            }
                                        @endphp -->
                                        <div class="progress-bar progress-success" style="width: {{$percentage}}%"><span class="progress-bar-text">{{ round($percentage)}}%</span></div>
                                    </div>
                                    <div class="task_progress-btm-date d-flex justify-content-between">
                                        <div><i class='bx bx-calendar' ></i> 
                                            @if($project->start_date)
                                                {{ \Carbon\Carbon::parse($project->start_date)->format('d M') }}
                                            @else
                                                No Start Date
                                            @endif
                                        </div>
                                        <div class="text-danger"><i class='bx bx-calendar' ></i> 
                                            @if($project->due_date)
                                                {{ \Carbon\Carbon::parse($project->due_date)->format('d M') }}
                                            @else
                                                No Due Date
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else 
        <div class="col-md-12">
            {{-- <h4 class="text text-danger">No Projects found.</h4> --}}
            <h4 class="text text-danger">No Projects found
                @if($query) 
                    with {{$query}}
                @endif
            </h4>
        </div>
        @endif
    </div>
    <hr>
    <!-- Pagination -->
    {{ $projects->links(data: ['scrollTo' => false]) }}
    
    <!-- Add Project Component -->
    <livewire:components.add-project @saved="$refresh" />
    
</div>
