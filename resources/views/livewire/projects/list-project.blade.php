<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Projects</li>
        </ol>
    </nav>

    <div class="dashboard-head mb-3">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Projects</h3>
                <span class="text-light">|</span>
                <a data-bs-toggle="modal" data-bs-target="#add-project-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Project</a>
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
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Status</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'active','byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($filter == 'active') active @endif">Active</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'overdue','byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($filter == 'overdue') active @endif">Overdue</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'completed','byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($filter == 'completed') active @endif">Completed</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'archived','byUser'=>$byUser, 'byTeam' => $byTeam])}}" class="btn-batch  @if($filter == 'archived') active @endif">Archived</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By User</h5>
                                        <select class="form-control" wire:model.live="byUser">
                                            <option value="all">All</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
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
            <div class="d-flex flex-wrap gap-4 align-items-center mb-2">
                <a class="active" href="#">All <span class="btn-batch">50</span></a>
                <a href="#">Active <span class="btn-batch">20</span></a>
                <a href="#">Completed <span class="btn-batch">15</span></a>
                <a href="#">Archive <span class="btn-batch">05</span></a>
            </div>
        </div>
        <div class="col-md-6">
            @if($sort != 'all' || $filter != 'all')
                <div class="d-flex flex-wrap gap-2 align-items-center justify-content-end">
                    <span class="pe-2"><i class='bx bx-filter-alt text-secondary'></i> Filter Results:</span>
                    @if($sort != 'all')
                        <span class="btn-batch">
                            @if($sort == 'newest') Newest @endif
                            @if($sort == 'a_z') A to Z @endif
                            @if($sort == 'z_a') Z to A @endif
                            <a wire:navigate href="{{ route('project.index',['sort'=>'all','filter'=>$filter]) }}" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                    @endif

                    @if($filter != 'all')
                        <span class="btn-batch">{{ ucfirst($filter) }} <a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>'all']) }}" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                    @endif

                    @if($byUser != 'all')
                        <span class="btn-batch">{{ $users->find($byUser)->name }} <a wire:navigate href="{{ route('project.index',['sort'=>$sort,'filter'=>$filter,'byUser'=>'all']) }}" class="ms-1"><i class='bx bx-x'></i></a></span>
                    @endif
                    

                    <a href="{{ route('project.index') }}" class="text-danger d-flex align-items-center">Reset <span class="ms-1 d-inline-flex"><i class='bx bx-refresh'></i></span></a>
                </div>
            @endif
        </div>
  
        @foreach($projects as $project)
            <div class="col-md-4 mb-3 mt-2">
                <div class="card_style h-100">
                    <!-- Edit -->
                    <div class="cus_dropdown cus_dropdown-edit">
                        <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    @if($project->trashed())
                                    <li><a href="javascript:;" wire:click="emitRestoreEvent({{ $project->id }})"><span><i class='bx bx-undo' ></i></span> Restore</a></li>
                                    <li><a href="javascript:;" wire:confirm="Are you sure you want to delete this project?" wire:click="emitForceDeleteEvent({{ $project->id }})"><span><i class='bx bx-trash' ></i></span> Delete Permanently</a></li>
                                    @else
                                    <li><a href="javascript:;" wire:click="emitEditEvent({{ $project->id }})"><span><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                    <li><a href="javascript:;" wire:confirm="Are you sure you want to delete this project?" wire:click="emitDeleteEvent({{ $project->id }})"><span><i class='bx bx-trash' ></i></span> Delete</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('project.profile', $project->id ) }}" class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                    <div class="card_style-project-head">
                        <div class="card_style-project-head-client"><span><i class='bx bx-briefcase-alt-2'></i></span> {{ $project->client->name }}</div>
                        <h4><a href="{{ route('project.profile',$project->id) }}" wire:navigate>{{ $project->name }}</a></h4>
                        <!-- Avatar Group -->
                        <div class="avatarGroup avatarGroup-lg avatarGroup-overlap mt-2">
                            @foreach($project->users as $user)
                                @if($user->image)
                                    <a href="javascript:;" class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$user->name}}">
                                        <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle">
                                    </a>
                                @else
                                    <a href="javascript:;" class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$user->name}}">{{ $user->initials }}</a>
                                @endif
                            @endforeach
                            
                        </div>
                    </div>
                    <!-- User this class for overdue (card_style-overdue) -->
                    <div class="card_style-project-body mt-3">
                        {{-- <div class="card_style-project-options">
                            <div><span><i class='bx bx-layer' ></i></span> 5 Attachments</div>
                            <div><span><i class='bx bx-calendar' ></i></span> {{ \Carbon\Carbon::parse($project->due_date)->diffInDays($project->start_date) }} Days</div>
                        </div> --}}
                        <div class="card_style-tasks">
                            <div class="card_style-tasks-title"><span><i class='bx bx-objects-horizontal-left' ></i></span> {{ $project->tasks->count() }} Tasks</div>
                            <div class="card_style-tasks-list">
                                <div class="card_style-tasks-item card_style-tasks-item-pending"><span><i class='bx bx-objects-horizontal-center' ></i></span>
                                    {{ $project->tasks->where('status', 'pending')->count() }} Active
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
                                <div class="progress" role="progressbar" aria-label="Project Progress" aria-valuemin="0" aria-valuemax="100">
                                    @php
                                        $percentage = 0;
                                        $completed = $project->tasks->where('status', 'completed')->count();
                                        $total = $project->tasks->count();
                                        if($total > 0){
                                            $percentage = ($completed / $total) * 100;  
                                        }else{
                                            $percentage = 0;
                                        }
                                    @endphp
                                    <div class="progress-bar progress-success" style="width: {{$percentage}}%"><span class="progress-bar-text">{{$percentage}}%</span></div>
                                </div>
                                <div class="task_progress-btm-date d-flex justify-content-between">
                                    <div><i class='bx bx-calendar' ></i> {{ \Carbon\Carbon::parse($project->start_date)->format('d M') }}</div>
                                    <div class="text-danger"><i class='bx bx-calendar' ></i> {{ \Carbon\Carbon::parse($project->due_date)->format('d M') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <hr>
    <!-- Pagination -->
    {{ $projects->links(data: ['scrollTo' => false]) }}
    
    <!-- Add Project Component -->
    <livewire:components.add-project @saved="$refresh" />
    
</div>
