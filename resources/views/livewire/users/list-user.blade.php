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
                    <h6 class="card-header">
                        <div>
                            <img src="{{ env('APP_URL') }}/storage/{{ $user->image }}" height="100px" width="100" class="img-thumbnail" alt="">
                        </div>
                        {{ $user->name }}
                    </h6>
                    <div class="card-body">
                        <p class="card-text">{{ $user->email }}</p>
                        <div class="avatarGroup avatarGroup-overlap">
                            @foreach($user->teams as $team)
                            <a href="#" class="avatarGroup-avatar">
                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $team->name }}">
                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $team->image }}" class="rounded-circle" />
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="">
                            <i class="bx bx-pencil btn btn-primary btn-sm" aria-hidden="true"></i>
                            <i class="bx bx-trash btn btn-primary btn-sm" aria-hidden="true"></i>
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
