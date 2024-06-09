<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Users</li>
        </ol>
    </nav>
    <div class="dashboard-head mb-4">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0 @if($filter == 'archived') archived_content @endif">All Users</h3>
                <span class="text-light">|</span>
                @can('Create User')
                <a data-bs-toggle="modal" data-bs-target="#add-user-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add User</a>
                @endcan
                <!-- <a wire:navigate href="{{ route('user.add') }}" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add User</a> -->
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Users...">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                    <div class="main-body-header-filters">
                        <div class="cus_dropdown" wire:ignore.self>
                            <div class="cus_dropdown-icon btn-border btn-border-secondary"><i class='bx bx-filter-alt' ></i> Filter</div>
                            <div class="cus_dropdown-body cus_dropdown-body-widh_l">
                                <div class="cus_dropdown-body-wrap">
                                    <div class="filterSort">
                                        <h5 class="filterSort-header"><i class='bx bx-sort-down text-primary' ></i> Sort By</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item">
                                                <a wire:navigate href="{{ route('user.index',['sort'=>'newest','filter'=>$filter])}}" class="btn-batch @if($sort == 'newest') active @endif">Newest</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="{{ route('user.index',['sort'=>'a_z','filter'=>$filter])}}" class="btn-batch @if($sort == 'a_z') active @endif"><i class='bx bx-down-arrow-alt' ></i> A To Z</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="{{ route('user.index',['sort'=>'z_a','filter'=>$filter])}}" class="btn-batch @if($sort == 'z_a') active @endif"><i class='bx bx-up-arrow-alt' ></i> Z To A</a>
                                            </li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Status</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('user.index',['sort'=>$sort,'filter'=>'all']) }}" class="btn-batch @if($filter == 'all') active @endif">All</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('user.index',['sort'=>$sort,'filter'=>'active'])}}" class="btn-batch @if($filter == 'active') active @endif">Active</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('user.index',['sort'=>$sort,'filter'=>'archived'])}}" class="btn-batch @if($filter == 'archived') active @endif">Archived</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Teams</h5>
                                        <select class="form-control" wire:model.live="byTeam" name="" id="">
                                            <option value="all">All</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id}}">{{ $team->name }}</option>
                                            @endforeach
                                        </select>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By Projects</h5>
                                        <select class="form-control" wire:model.live="byProject" name="" id="">
                                            <option value="all">All</option> 
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id}}">{{ $project->name }}</option>
                                                
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
                <a class="@if($filter == 'all') active @endif" wire:navigate href="{{ route('user.index',['sort'=>$sort,'filter'=>'all']) }}">All <span class="btn-batch">{{$allUsers}}</span></a>
                <a class="@if($filter == 'active') active @endif" wire:navigate href="{{ route('user.index',['sort'=>$sort,'filter'=>'active']) }}">Active <span class="btn-batch">{{$activeUsers}}</span></a>
                <a class="@if($filter == 'archived') active @endif" wire:navigate href="{{ route('user.index',['sort'=>$sort,'filter'=>'archived']) }}">Archive <span class="btn-batch">{{$archivedUsers}}</span></a>
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
                            <a href="{{ route('user.index',['sort'=>'all','filter'=>$filter]) }}" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                    @endif

                    @if($filter != 'all')
                        <span class="btn-batch">{{ ucfirst($filter) }} <a href="{{ route('user.index',['sort'=>$sort,'filter'=>'all']) }}" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                    @endif

                    @if($byUser != 'all')
                        <span class="btn-batch">{{ $users->find($byUser)->name }} <a href="{{ route('user.index',['sort'=>$sort,'filter'=>$filter,'byUser'=>'all']) }}" class="ms-1"><i class='bx bx-x'></i></a></span>
                    @endif
                    
                    <a href="{{ route('user.index') }}" class="text-danger d-flex align-items-center">Reset <span class="ms-1 d-inline-flex"><i class='bx bx-refresh'></i></span></a>
                </div>
            @endif
        </div>

        @if($users->isNotEmpty())
        @foreach($users as $user)
            <div class="col-md-4 mb-4">
                <div class="card_style card_style-user h-100">
                    <a href="{{ route('user.profile',$user->id) }}" class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                    <div class="card_style-user-head">
                        <div class="card_style-user-profile-img">
                            @if($user->image)
                                <img src="{{ env('APP_URL') }}/storage/{{ $user->image }}" alt="{{ $user->name }}">
                            @else
                                <span class="avatar avatar-{{$user->color}}">{{ $user->initials }}</span>
                            @endif
                        </div>
                        <div class="card_style-user-profile-content mt-2">
                            <h4><a wire:navigate href="{{ route('user.profile',$user->id) }}">{{ $user->name }}</a></h4>
                            <div class="d-flex align-items-center justify-content-center"><i class='bx bx-envelope me-1 text-secondary' ></i> {{ $user->email }}</div>
                            <div class="d-flex align-items-center justify-content-center mt-2"><i class='bx bx-briefcase me-1 text-primary'></i> {{ $user->designation ?? 'Not Added'}} </div>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <i class='bx bx-sitemap me-1 text-secondary'></i> 
                                @if(!$user->mainTeam)
                                    Not Added
                                @else
                                   {{ $user->mainTeam->name }}
                                @endif
                            </div>


                            @if($user->teams->count() > 0)
                                <div class="card_style-user-head-team"><span class="btn-batch btn-batch-warning"> {{ $user->teams->count() }}  {{ $user->teams->count() >1 ? 'Teams' : 'Team'}}</span></div>
                            @endif
                        </div>
                    </div>
                    <div class="card_style-user-body mt-3">
                        <div class="card_style-options d-none">
                            <div class="card_style-options-head"><span><i class='bx bx-layer text-secondary' ></i></span> 30 Projects <span class="text-dark-grey ms-1">|</span> 5 Clients</div>
                            <div class="card_style-options-list d-flex">
                                <div class="text-primary">Active <span class="btn-batch-bg btn-batch-bg-primary">10 Projects</span></div>
                                <div class="text-success ms-4">Completed <span class="btn-batch-bg btn-batch-bg-success">5 Projects</span></div>
                            </div>
                        </div>
                        <div class="card_style-tasks text-center">
                            <div class="card_style-tasks-title"><span><i class='bx bx-objects-horizontal-left' ></i></span> {{ $user->tasks->count() }}  {{ $user->tasks->count() >1 ? 'Tasks' : 'Task'}}</div>
                            <div class="card_style-tasks-list justify-content-center mt-2">
                                <div class="card_style-tasks-item card_style-tasks-item-pending"><span><i class='bx bx-objects-horizontal-center' ></i></span>
                                {{-- {{
                                    $user->tasks->where(function($query) {
                                        $query->where('status', 'pending')->orWhere('status', 'in_progress')->orWhere('status', 'in_review');
                                    })->count()
                                }} Active
                                 --}}
                                 {{ 
                                    $user->tasks->filter(function($task) {
                                        return in_array($task->status, ['pending', 'in_progress', 'in_review']);
                                    })->count() 
                                }} Active
                            
                            </div>
                                <div class="card_style-tasks-item card_style-tasks-item-overdue"><span><i class='bx bx-objects-horizontal-center' ></i></span>{{ $user->tasks->where('due_date', '<', now())->where('status','!=','completed')->count() }} Overdue</div>
                                <div class="card_style-tasks-item card_style-tasks-item-done"><span><i class='bx bx-objects-horizontal-center' ></i></span>{{ $user->tasks->where('status', 'completed')->count() }}  Completed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach 
        @else 
        <div class="col-md-12">
            {{-- <h4 class="text text-danger">No Users found.</h4> --}}
            <h4 class="text text-danger">No Users found 
               @if($query) 
                 with {{$query}}
               @endif
            </h4>
        </div>
        @endif

        <!-- Pagination -->
        {{ $users->links(data: ['scrollTo' => false]) }}
    </div>

    <!-- User Modal Component -->

    <livewire:components.add-user  @saved="$refresh" />
    
</div>
