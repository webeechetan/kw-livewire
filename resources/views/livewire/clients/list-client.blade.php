<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Webeesocial</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Clients</li>
        </ol>
    </nav>

    <div class="dashboard-head mb-3">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0 @if($filter == 'archived') archived_content @endif">All Clients</h3>
                <span class="text-light">|</span>
                @can('Create Client')
                    <a data-bs-toggle="modal" data-bs-target="#add-client-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Client</a>
                @endcan
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Company">
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
                                            <li class="filterSort_item">
                                                <a wire:navigate href="{{ route('client.index',['sort'=>'newest','filter'=>$filter])}}" class="btn-batch  @if($sort == 'newest') active @endif" >Newest</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="{{ route('client.index',['sort'=>'a_z','filter'=>$filter])}}" class="btn-batch  @if($sort == 'a_z') active @endif"><i class='bx bx-down-arrow-alt' ></i> A To Z</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="{{ route('client.index',['sort'=>'z_a','filter'=>$filter]) }}" class="btn-batch  @if($sort == 'z_a') active @endif"><i class='bx bx-up-arrow-alt' ></i> Z To A</a>
                                            </li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Status</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('client.index',['sort'=>$sort,'filter'=>'all']) }}" class="btn-batch @if($filter == 'all') active @endif">All</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('client.index',['sort'=>$sort,'filter'=>'active']) }}" class="btn-batch  @if($filter == 'active') active @endif">Active</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('client.index',['sort'=>$sort,'filter'=>'completed']) }}" class="btn-batch  @if($filter == 'completed') active @endif">Completed</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="{{ route('client.index',['sort'=>$sort,'filter'=>'archived']) }}" class="btn-batch  @if($filter == 'archived') active @endif">Archive</a></li>
                                        </ul>
                                        {{--<hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By Projects</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Active</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Completed</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Archive</a></li>
                                        </ul> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Body -->
    <div class="row">
        <div class="col-md-6">
            <div class="dashboard_filters d-flex flex-wrap gap-4 align-items-center mb-4">
             
                <a class="@if($filter == 'all') active @endif" wire:navigate href="{{ route('client.index',['sort'=>$sort,'filter'=>'all']) }}">All <span class="btn-batch">{{$allClients}}</span></a>
                <a class="@if($filter == 'active') active @endif" wire:navigate href="{{ route('client.index',['sort'=>$sort,'filter'=>'active']) }}">Active <span class="btn-batch">{{$activeClients}}</span></a>
                <a class="@if($filter == 'completed') active @endif" wire:navigate href="{{ route('client.index',['sort'=>$sort,'filter'=>'completed']) }}">Completed <span class="btn-batch">{{$completedClients}}</span></a>
                <a class="@if($filter == 'archived') active @endif" wire:navigate href="{{ route('client.index',['sort'=>$sort,'filter'=>'archived']) }}">Archive <span class="btn-batch">{{$archivedClients}}</span></a>
            </div>
        </div>
        <div class="col-md-6">
        @if($sort != 'all' || $filter != 'all')
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-end mb-2">
                <span class="pe-2"><i class='bx bx-filter-alt text-secondary'></i> Filter Results:</span>
                @if($sort != 'all')
                    <span class="btn-batch">
                        @if($sort == 'newest') Newest @endif
                        @if($sort == 'a_z') A to Z @endif
                        @if($sort == 'z_a') Z to A @endif
                        <a wire:navigate href="{{ route('client.index',['sort'=>'all','filter'=>$filter]) }}" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif

                @if($filter != 'all')
                    <span class="btn-batch">{{ ucfirst($filter) }} <a wire:navigate href="{{ route('client.index',['sort'=>$sort,'filter'=>'all']) }}" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                @endif
                

                <a href="{{ route('client.index') }}" class="text-danger d-flex align-items-center">Reset <span class="ms-1 d-inline-flex"><i class='bx bx-refresh'></i></span></a>
            </div>
        @endif
        </div>

        @if($clients->isNotEmpty())
            @foreach($clients as $client)
            @php
                $activeProjects = $client->projects->where('status', 'active');
                $completedProjects = $client->projects->where('status', 'completed');
            @endphp
            <div class="col-md-4 mb-4"  wire:key="{{ $client->id }}">
                <div class="card_style card_style-client h-100">
                    <div wire:loading wire:target="emitDeleteEvent({{ $client->id }})" class="card_style-loader">
                        <div class="card_style-loader-wrap"><i class='bx bx-trash text-danger me-2' ></i> Removing ...</div>
                    </div>
                    <a href="{{ route('client.profile', $client->id ) }}" class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                    <div class="card_style-head card_style-client-head mb-3">
                        @if($client->image != 'default.png')
                            <div><img src="{{ asset('storage/'.$client->image) }}" alt="" class="img-fluid"></div>
                        @else
                            <div class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $client->initials }}">{{ $client->initials }}</div>
                        @endif
                        <div>
                            <h4 class="mb-1">
                                <a wire:navigate href="{{ route('client.profile', $client->id ) }}">
                                    {{ Str::limit($client->visible_name, 20, '...') }}
                                </a>
                            </h4>
                            <div class="btn-withIcon"><i class='bx bx-layer text-secondary' ></i> {{ $client->projects->count() }}  {{ $client->projects->count() >1 ? 'Projects' : 'Project' }}</div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        <h4 class="text-md mb-0">Active <span class="btn-batch-bg btn-batch-bg-secondary ms-2">{{count($activeProjects)}} {{count($activeProjects) >1 ? 'Projects' : 'Project'}}</span></h4>
                        <span class="px-2 text-grey">|</span>
                        <h4 class="text-md mb-0">Completed <span class="btn-batch-bg btn-batch-bg-success ms-2">{{count($completedProjects)}} {{count($completedProjects) >1 ? 'Projects' : 'Project'}}</span></h4>
                    </div>
                    <hr class="my-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            {{-- <h4 class="text-md mb-0"><i class="bx bx-user text-primary"></i> {{count($client->users)}} Users</h4> --}}
                            <h4 class="text-md mb-0"><i class="bx bx-user text-primary"></i>{{ count($client->users) > 1 ? 'Users' : 'User' }}</h4> 
                        </div>
                        <div class="col">
                            <div class="avatarGroup avatarGroup-overlap">
                                @php
                                    $plus_more_users = 0;
                                    if(count($client->users) > 7){
                                        $plus_more_users = count($client->users) - 7;
                                    }
                                @endphp
                                @foreach($client->users as $user)
                                    @if($user->image)
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">
                                                <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle">
                                            </span>
                                        </a>
                                    @else
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">{{ $user->initials }}</span>
                                        </a>
                                    @endif
                                    
                                @endforeach
                                @if($plus_more_users)
                                    <a href="#" class="avatarGroup-avatar">
                                        <span class="avatar avatar-sm avatar-more">+{{$plus_more_users}}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card_style-client-body">
                        <div class="card_style-projects_tab">

                            <ul class="nav nav-pills mb-2" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <div class="card_style-projects_tab-title active text-primary"  data-bs-toggle="pill" data-bs-target="#active-{{$client->id}}" role="tab" aria-controls="pills-home" aria-selected="true">Active <span class="btn-batch-bg btn-batch-bg ms-2">{{count($activeProjects)}} Projects</span></div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <div class="card_style-projects_tab-title text-success" data-bs-toggle="pill" data-bs-target="#completed-{{$client->id}}" role="tab" aria-controls="pills-profile" aria-selected="false">Completed <span class="btn-batch-bg btn-batch-bg-success ms-2">{{count($completedProjects)}} Projects</span></div>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="active-{{$client->id}}" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="card_style-projects_tab-items align-items-center">
                                        <i class="bx bx-user text-primary"></i>
                                        <!-- Avatar Group (Add + More option after 6) -->
                                        <div class="avatarGroup avatarGroup-lg">
                                            @php
                                                $plus_more_projects = 0;
                                                if(count($activeProjects) > 7){
                                                    $plus_more_projects = count($activeProjects) - 7;
                                                }
                                            @endphp
                                            @foreach($activeProjects as $project)
                                                @if($loop->index < 7)
                                                    <a wire:navigate href="{{ route('project.profile',$project->id) }}" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $project->name }}">
                                                            <img alt="avatar" src="{{ asset('storage/'.$project->image) }}" class="rounded-circle">
                                                        </span>
                                                    </a>
                                                @endif
                                            @endforeach
                                            @if($plus_more_projects > 0)
                                                <a href="#" class="avatarGroup-avatar">
                                                    <span class="avatar avatar-more" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $plus_more_projects }} more projects">
                                                        <span class="avatar-more-text">+{{ $plus_more_projects }}</span>
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="completed-{{$client->id}}" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div class="card_style-projects_tab-items">
                                        <!-- Avatar Group (Add + More option after 6) -->
                                        <div class="avatarGroup avatarGroup-lg mt-2">
                                            @foreach($completedProjects as $project)
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $project->name }}">
                                                    <img alt="avatar" src="{{ asset('storage/'.$project->image) }}" class="rounded-circle">
                                                </span>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            @endforeach
            @else
            <div class="col-md-12">
                <h4 class="text text-danger">No clients found.
                    @if($query) 
                        with {{$query}}
                    @endif
                </h4>
            </div>
        @endif
    </div>
    <hr>
    <!-- Pagination -->
    {{ $clients->links(data: ['scrollTo' => false]) }}

    <!-- Client Modal Component -->
    <livewire:components.add-client @saved="$refresh" />
</div>
