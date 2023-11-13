<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <h5 class="card-header">Add Task</h5>
                <div class="card-body">
                    <form wire:submit="store" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Title</label>
                                <input type="text" wire:model="name" class="form-control" placeholder="Enter Title">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="password">Due Date</label>
                                <input type="date" wire:model="dueDate" class="form-control" >
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Description</label>
                                <textarea wire:model="description" class="form-control" id="" cols="30" rows="3"></textarea>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" wire:ignore>
                                <label for="email">Assign To</label>
                                <select name="" id="" class="form-control users" multiple>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Assign To Team</label>
                                <select wire:model="team_id" name="" id="" class="form-control teams">
                                    <option value="">Select Team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.users').select2();

        $('.users').on('change', function(e){
            var users = $('.users');
            var selected_users = users.val();
            @this.set('user_ids', selected_users);
        });
    </script>
@endpush



