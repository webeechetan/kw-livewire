<div>
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
                        <h3 class="main-body-header-title mb-0">{{ $client->name }}</h3>
                        <div class="client_head-date">
                            {{ \Carbon\Carbon::parse($client->onboard_date)->format('d M-Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabNavigationBar-tab border_style mb-3">
        <a class="tabNavigationBar-item" href="{{ route('client.profile', $client->id) }}"><i class='bx bx-line-chart'></i> Overview</a>
        <a class="tabNavigationBar-item" href="{{ route('client.projects', $client->id) }}"><i class='bx bx-layer' ></i> Projects</a>
        <a class="tabNavigationBar-item active" href="{{ route('client.file-manager', $client->id ) }}"><i class='bx bx-objects-horizontal-left' ></i> File Manager</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <livewire:components.file-manager :client="$client" />
        </div>
    </div>
    
    <livewire:components.add-client @saved="$refresh" />

</div>
