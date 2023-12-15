<div class="container-fluid">

    <div class="row">
        <div class="col-md-6">
            <form wire:submit="search" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Teams...">
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a wire:navigate href="{{ route('team.add') }}" class="btn btn-primary">Add New Team</a>
        </div>
    </div>
    <div class="row mt-4">
        
        @foreach($teams as $team)
            <div class="col-md-4 mt-2">
                <div class="card text-center">
                    <h6 class="card-header">{{ $team->name }}</h6>
                    <div class="card-body">
                        <p class="card-text">{{ $team->description }}</p>
                        <div class="taskList_col">
                            <div class="avatarGroup avatarGroup-overlap">
                                @foreach($team->users as $user)
                                <a href="#" class="avatarGroup-avatar">
                                    <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                        <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" />
                                    </span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="">
                            <a wire:navigate href="{{ route('team.edit' , $team->id ) }}"><i class="bx bx-pencil btn btn-primary btn-sm" aria-hidden="true"></i></a>
                            <i class="bx bx-trash btn btn-primary btn-sm" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagintaions mt-4">
            {{ $teams->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
