<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Clients</li>
        </ol>
    </nav>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Clients</h3>
                <span class="text-light">|</span>
                <a data-bs-toggle="modal" data-bs-target="#add-client-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Client</a>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Clients...">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                    <div class="main-body-header-filters">
                        <div class=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        @foreach($clients as $client)
        @php
            $activeProjects = $client->projects->where('status', 'active');
            $completedProjects = $client->projects->where('status', 'completed');
        @endphp
        <div class="col-md-4"  wire:key="{{ $client->id }}">
            <div wire:loading wire:target="emitDeleteEvent({{ $client->id }})" class="alert alert-warning">  
                Removing post...
            </div>
            <div class="card_style card_style-client">
                <!-- Edit -->
                <div class="cus_dropdown">
                    <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                    <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                        <div class="cus_dropdown-body-wrap">
                            <ul class="cus_dropdown-list">
                                <li class="edit_client" wire:click="emitEditEvent({{ $client->id }})"><a href="javascript:"><span class="text-secondary "><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                <li><a href="javascript:" wire:click="emitDeleteEvent({{ $client->id }})"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card_style-client-head">
                    <div><img src="{{ asset('storage/'.$client->image) }}" alt="" class="img-fluid"></div>
                    <div>
                        <h4><a wire:navigate href="{{ route('client.profile', $client->id ) }}">{{ $client->name }}</a></h4>
                        <div class="btn-withIcon">{{ $client->projects->count() }} Projects</div>
                    </div>
                </div>
                <div class="card_style-client-body">
                    <div class="card_style-projects_tab">
                        <ul class="nav nav-pills mb-3" role="tablist">
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
                                    @foreach($activeProjects as $project)
                                        <span class="btn-batch">{{ $project->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="completed-{{$client->id}}" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="card_style-projects_tab-items">
                                    @foreach($completedProjects as $project)
                                        <span class="btn-batch btn-batch-success">{{ $project->name }}</span>
                                    @endforeach
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
