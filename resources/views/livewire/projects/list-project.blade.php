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
            <a wire:navigate href="{{ route('project.add') }}" class="btn btn-primary">Add New Project</a>
        </div>
    </div>
    
    <div class="row mt-4">
        @foreach($projects as $project)
            <div class="col-md-4 mt-2">
                <div class="card">
                    <h5 class="card-header">{{ $project->client->name }} - {{ $project->name }}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ $project->description }}</p>
                        <a wire:navigate href="" class="btn btn-primary">Edit</a>
                        <button wire:click="delete({{ $project->id }})" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagintaions mt-4">
            {{ $projects->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
