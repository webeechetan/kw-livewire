<div class="container-fluid">

    <div class="row">
        <div class="col-md-6">
            <form wire:submit="search" action="">
                <div class="input-group">
                    <input wire:model="query" type="text" class="form-control" placeholder="Search Clients...">
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a wire:navigate href="{{ route('client.add') }}" class="btn btn-primary">Add New Client</a>
        </div>
    </div>
    
    <div class="row mt-4">
        
        @foreach($clients as $client)
            <div class="col-md-4 mt-2">
                <div class="card text-center">
                    <h6 class="card-header">{{ $client->name }}</h6>
                    <div class="card-body">
                        <p class="card-text">{{ $client->description }}</p>
                        @foreach($client->projects as $project)
                            <span class="btn btn-warning btn-sm">{{ $project->name }}</span>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted">
                        <div class="">
                            <a wire:navigate href="{{ route('client.edit',$client->id) }}"><i class="bx bx-pencil btn btn-primary btn-sm" aria-hidden="true"></i></a>
                            <i wire:confirm="Are you sure you want to delete this client?" wire:click="deleteClient({{$client->id}})" class="bx bx-trash btn btn-primary btn-sm" aria-hidden="true"></i>
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
