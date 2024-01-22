<div class="container">
    <!-- Dashboard Header -->
    <div class="row align-items-center">
        <div class="col">
            <h3 class="main-body-header-title mb-0">All Clients</h3>
        </div>
        <div class="text-end col">
            <div class="main-body-header-right">
                <form class="search-box" wire:submit="search" action="">
                    <input wire:model="query" type="text" class="form-control" placeholder="Search Clients...">
                    <button type="submit" class="search-box-icon"><i class='bx bx-search'></i></button>
                </form>
                <a wire:navigate href="{{ route('client.add') }}" href="javascript:void(0);" class="btn-border btn-border-primary"><i class="bx bx-plus"></i> Add Client</a>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        @foreach($clients as $client)
        <div class="col-md-4">
            <div class="card_style card_style-client">
                <div class="card_style-client-head">
                    <div><img src="{{ asset('storage/'.$client->image) }}" alt="" class="img-fluid"></div>
                    <h4><a wire:navigate href="{{ route('client.profile', $client->id ) }}">{{ $client->name }}</a></h4>
                </div>
                <div class="card_style-client-body">
                    <div class="card_style-client-body-title"><i class='bx bx-network-chart' ></i> Active Projects</div>
                    <div class="card_style-client-projects">
                        <div class="card_style-client-project">
                            @foreach($client->projects as $project)
                                <span class="btn btn-warning btn-sm">{{ $project->name }}</span>
                            @endforeach
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
</div>
