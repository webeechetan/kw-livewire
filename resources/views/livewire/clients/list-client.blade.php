<div class="container">
    <!-- Dashboard Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-start">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Webeesocial</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Clients</li>
            </ol>
        </nav>
    </div>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Clients</h3>
                <span class="text-light">|</span>
                <a data-bs-toggle="modal" data-bs-target="#add-client-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Client</a>
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Companies">
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
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                                        <ul class="filterSort_btn_group list-none">
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
    
    <div class="row">
        @if($sort != 'all' || $filter != 'all')
            <div class="d-flex flex-wrap gap-2 align-items-center py-3">
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

        @foreach($clients as $client)
        @php
            $activeProjects = $client->projects->where('status', 'active');
            $completedProjects = $client->projects->where('status', 'completed');
        @endphp
        <div class="col-md-4 mb-4 mt-2"  wire:key="{{ $client->id }}">
            <div class="card_style card_style-client h-100">
                <div wire:loading wire:target="emitDeleteEvent({{ $client->id }})" class="card_style-loader">
                    <div class="card_style-loader-wrap"><i class='bx bx-trash text-danger me-2' ></i> Removing ...</div>
                </div>
                <!-- Edit -->
                <div class="cus_dropdown cus_dropdown-edit">
                    <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                    <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                        <div class="cus_dropdown-body-wrap">
                            <ul class="cus_dropdown-list">
                                @if($client->trashed())
                                    <li><a href="javascript:" wire:click="emitRestoreEvent({{ $client->id }})"><span><i class='bx bx-recycle'></i></span> Restore</a></li>
                                    <li><a href="javascript:" wire:click="emitForceDeleteEvent({{ $client->id }})"><span><i class='bx bx-trash'></i></span> Permanent Delete</a></li>
                                @else
                                    <li class="edit_client" wire:click="emitEditEvent({{ $client->id }})"><a href="javascript:"><span><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                    <li><a href="javascript:" wire:click="emitDeleteEvent({{ $client->id }})"><span><i class='bx bx-trash' ></i></span> Delete</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card_style-client-head">
                    <div><img src="{{ asset('storage/'.$client->image) }}" alt="" class="img-fluid"></div>
                    <div>
                        <h4>
                            <a wire:navigate href="{{ route('client.profile', $client->id ) }}">
                                {{ Str::limit($client->visible_name, 20, '...') }}
                            </a>
                        </h4>
                        <div class="btn-withIcon"><i class='bx bx-layer text-secondary' ></i> {{ $client->projects->count() }} Projects</div>
                    </div>
                </div>
                <div class="card_style-client-body">
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
                                <div class="card_style-projects_tab-items">
                                    <!-- Avatar Group (Add + More option after 6) -->
                                    <div class="avatarGroup avatarGroup-lg mt-2">
                                        @php
                                            $plus_more_projects = 0;
                                            if(count($activeProjects) > 7){
                                                $plus_more_projects = count($activeProjects) - 7;
                                            }
                                        @endphp
                                        @foreach($activeProjects as $project)
                                            @if($loop->index < 7)
                                                <a wire:navigate href="{{ route('project.profile',$project->id) }}" class="avatarGroup-avatar">
                                                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $project->name }}">
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
                </div>
            </div>
        </div>
        @endforeach

        <div class="pagintaions mt-4">
            {{ $clients->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Client Modal Component -->
    <livewire:components.add-client @saved="$refresh" />
</div>
