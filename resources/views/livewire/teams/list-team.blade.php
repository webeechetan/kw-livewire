<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Teams</li>
        </ol>
    </nav>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Teams</h3>
                <span class="text-light">|</span> 
                @can('Create Team')
                    <a data-bs-toggle="modal" data-bs-target="#add-team-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Team</a>
                    <!-- <a wire:navigate href="{{ route('team.add') }}" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Team</a> -->
                @endcan
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Teams...">
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
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('team.index',['sort'=>'newest','filter'=>$filter])}}" class="btn-batch @if($sort == 'newest') active @endif" >Newest</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('team.index',['sort'=>'a_z','filter'=>$filter])}}" class="btn-batch @if($sort == 'a_z') active @endif"><i class='bx bx-down-arrow-alt' ></i> A To Z</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('team.index',['sort'=>'z_a','filter'=>$filter])}}" class="btn-batch @if($sort == 'z_a') active @endif"><i class='bx bx-up-arrow-alt' ></i> Z To A</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By User</h5>
                                        <select class="form-control" wire:model.live="byUser">
                                            <option value="all">All</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name}}</option>
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

    <div class="row mt-4">

        <div class="col-md-6">
            <div class="dashboard_filters d-flex flex-wrap gap-4 align-items-center mb-4">
                <a class="@if($filter == 'all') active @endif" wire:navigate href="{{ route('team.index',['sort'=>$sort,'filter'=>'all']) }}">All <span class="btn-batch">{{ $allTeams }}</span></a>
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
                            <a href="{{ route('team.index',['sort'=>'all','filter'=>$filter]) }}" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                    @endif                    

                    <a href="{{ route('team.index') }}" class="text-danger d-flex align-items-center">Reset <span class="ms-1 d-inline-flex"><i class='bx bx-refresh'></i></span></a>
                </div>
            @endif
        </div>
        
        @if($teams->isNotEmpty())
        @foreach($teams as $team)

            <div class="col-md-4 mb-4">
                <div class="card_style card_style-team">
                    <a href="{{ route('team.profile',$team->id) }}" class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                    {{-- <div class="card_style-star_active"><span class="text-success"><i class='bx bxs-star' ></i></span></div> --}}
                    <div class="card_style-list_head">
                        
                        <div class="card_style-team-profile-img"><span><div class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$team->name}}">{{$team->initials}}</div></span></div>
                        <div class="card_style-team-profile-content">
                            <h4 class="mb-2"><a wire:navigate href="{{ route('team.profile',$team->id) }}">{{ $team->name }}</a></h4>
                            <div class="mb-2">
                                {{-- <span class="font-500"><i class='bx bx-user text-success' ></i> Manager</span> @if($team->manager)<span class="btn-batch ms-2">{{ $team->manager?->name }}</span> @endif --}}

                                <span class="font-500 me-3"><i class='bx bx-user text-success' ></i> Manager</span> 
                                    @if($team->manager)
                                        {{-- <span class="btn-batch ms-2">{{ $team->manager?->name }}</span>--}}
                                        <a href="javascript:;"class="avatar avatar-orange avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{$team->manager?->name}}"> {{ $team->manager?->initials ?? 'NA' }}</a>
                                        
                                    @endif
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <div>
                                        {{ $team->users->count() }}   {{ $team->users->count() >1  ?'Members' : 'Member'}}
                                    </div>
                                </div>
                                <div class="col-auto px-0">
                                    <span class="text-dark-grey ms-1">|</span>
                                </div>
                                <div class="col">
                                    <div class="avatarGroup avatarGroup-overlap">
                                        @foreach($team->users as $user)
                                            @if($user->image)
                                                <a href="javascript:;" class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$user->name}}">
                                                    <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle">
                                                </a>
                                            @else
                                                <a href="javascript:;" class="avatar avatar-{{ $user->color }} avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$user->name}}">{{ $user->initials }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="card_style-options">
                        <div class="card_style-options-head">
                            <span>
                                <i class='bx bx-layer text-secondary' ></i>
                            </span> 
                            {{-- 15 Projects  --}}
                            @php
                                $project_text = 'Projects';    
                            @endphp
                            @if($team->projects->count() > 1)
                                @php
                                    $project_text = 'Projects';    
                                @endphp
                            @else
                                @php
                                    $project_text = 'Project';    
                                @endphp
                            @endif
                            {{ $team->projects->count() }} {{ $project_text }}
                            <span class="text-dark-grey ms-1">|</span>
                            <span href="#" class="text-secondary"> <i class='bx bx-briefcase-alt-2' ></i></span> 
                            {{-- 5 Clients  --}}
                            @php
                                $client_text = 'Clients';
                            @endphp

                            @if($team->clients->count() > 1)
                                @php
                                    $client_text = 'Clients';    
                                @endphp
                            @else
                                @php
                                    $client_text = 'Client';    
                                @endphp
                            @endif
                            {{ $team->clients->count() }} {{ $client_text }}        
                        
                            <span class="text-dark-grey ms-1">|</span> 
                            <span href="#"><i class='bx bx-objects-horizontal-left text-primary' ></i></span>
                            {{-- 60 Tasks --}}
                            @php
                                $task_text = 'Tasks';
                            @endphp

                            @if($team->tasks->count() > 1)
                                @php
                                // echo($team->tasks->count());
                                    $task_text = 'Tasks';    
                                @endphp
                            @else
                                @php
                                    $task_text = 'Task';    
                                @endphp
                            @endif
                            {{ $team->users->count() }} {{ $task_text }}  
                        </div>
                        <div class="card_style-options-head">
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @else
        <div class="col-md-12">               
            {{-- <h4 class="text text-danger">No Teams found.</h4> --}}
            <h4 class="text text-danger">No Teams found 
                @if($query) 
                    with {{$query}}
                @endif
            </h4>
        </div>
        @endif
        <div class="pagintaions mt-4">
            {{ $teams->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Team Modal -->

    <livewire:components.add-team />
    
</div>








{{-- 

<a href="javascript:;" class="avatar avatar-{{ $user->color }} avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$user->name}}">{{ $user->initials }}</a>

<span class="font-500"><i class='bx bx-user text-success' ></i> Manager</span> @if($team->manager)<span class="btn-batch ms-2">{{ $team->manager?->name }}</span> @endif  --}}
