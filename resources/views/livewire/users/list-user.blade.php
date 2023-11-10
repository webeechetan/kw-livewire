<div class="container-fluid">

    <div class="row">
        <div class="col-md-6">
            <form wire:submit="search" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Users...">
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a wire:navigate href="{{ route('user.add') }}" class="btn btn-primary">Add New User</a>
        </div>
    </div>
    <div class="row mt-4">
        
        @foreach($users as $user)
            <div class="col-md-4 mt-2">
                <div class="card text-center">
                    <h6 class="card-header">{{ $user->name }}</h6>
                    <div class="card-body">
                        <p class="card-text">{{ $user->email }}</p>
                        {{-- @foreach($user->projects as $project)
                            <span class="btn btn-warning btn-sm">{{ $project->name }}</span>
                        @endforeach --}}
                    </div>
                    <div class="card-footer text-muted">
                        <div class="">
                            <i class="fa fa-pencil btn btn-primary btn-sm" aria-hidden="true"></i>
                            <i class="fa fa-trash btn btn-primary btn-sm" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagintaions mt-4">
            {{ $users->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
