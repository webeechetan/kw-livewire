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
                        <h3 class="main-body-header-title mb-0">{{ $client->visible_name }}</h3>
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
        <a class="tabNavigationBar-item active" href="{{ route('client.profile', $client->id) }}"><i class='bx bx-line-chart'></i> Overview</a>
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
                        <h5 class="title-md mb-1">{{ $client->projects->count() }}</h5>
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
                        <h5 class="title-md mb-1">{{ $client_teams->count() }}</h5>
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
                        <h5 class="title-md mb-1">{{ $client_users->count() }}</h5>
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
                <div>{!! $client->description !!}</div>
                <h5 class="column-title mt-4">Teams</h5>
                <hr>
                <!-- Teams -->
                <div class="team-list row">
                    @foreach($client_teams as $team)
                        <div class="col-auto">
                            <div class="team team-style_2 editTeam">
                                <div class="team-style_2-head_wrap">
                                    <div class="team-avtar">
                                        <span>
                                            <img src="{{ env('APP_URL') }}/storage/{{ $team->image }}" alt="">
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="team-style_2-title">{{$team->name}}</h4>
                                        <div class="avatarGroup avatarGroup-overlap">
                                            @foreach($team->users as $user)
                                                @if($client_users->contains($user->id))
                                                    <a href="#" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="{{ $user->name }}" data-bs-original-title="{{ $user->name }}">
                                                            <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/users/{{ $user->name }}.png" class="rounded-circle">
                                                        </span>
                                                    </a>
                                                @endif
                                            @endforeach
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
                        <div class="col text-secondary">@if($client->createdBy) {{ $client->createdBy->name }} @else Auto Generated @endif</div>
                    </div>
                </div>
                <div class="column-box bg-light mb-2">
                    <div class="row align-items-center">
                        <div class="col"><span><i class='bx bx-calendar text-success'></i></span> Onboard Date</div>
                        <div class="col text-success">{{ \Carbon\Carbon::parse($client->onboard_date)->format('d M-Y') }}</div>
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

    <livewire:components.add-client @saved="$refresh" />
    
</div>
@push('scripts')
<script>
    
</script>
@endpush
