<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('client.index') }}">All Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $client->name }}</li>
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
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="column-box font-500">
                <div class="row align-items-center">
                    <div class="col"><span><i class='bx bx-layer text-secondary' ></i></span> Created By</div>
                    <div class="col text-secondary">@if($client->createdBy) {{ $client->createdBy->name }} @else Auto Generated @endif</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="column-box font-500">
                <div class="row align-items-center">
                    <div class="col"><span><i class='bx bx-calendar text-success'></i></span> Onboard Date</div>
                    <div class="col text-success">{{ \Carbon\Carbon::parse($client->onboard_date)->format('d M Y') }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="column-box font-500">
                <div class="row align-items-center">
                    <div class="col"><span><i class='bx bx-user text-primary'></i></span> Point Of Contact</div>
                    <div class="col text-primary">{{ $client->point_of_contact }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="column-box mb-4">
        <div class="row">
            <div class="col-sm-auto pe-5">
                <h5 class="column-title mb-0">Teams</h5>
            </div>
            <div class="col">
                <!-- Teams -->
                <div class="team-list row">
                    @forelse($client_teams as $team)
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
                        @empty
                        <div>No Team Assigned</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="column-box">
        <div class="column-title mb-3">Description</div>
        <div>
            @if($client->description)
                {!! $client->description !!}
            @else
                <p class="text-muted">No Description Available</p>
            @endif
        </div>
    </div>
</div>
@push('scripts')
<script>
    
</script>
@endpush
