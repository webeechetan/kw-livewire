<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <h5 class="card-header">Add User</h5>
                <div class="card-body">
                    <div class="row">
                        <form wire:submit="store" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="name">User Name</label>
                                <input type="text" wire:model="name" name="name" class="form-control" placeholder="Enter Client Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="email">Email</label>
                                <input type="text" wire:model="email" name="email" class="form-control" placeholder="Enter Email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="password">Password</label>
                                <input type="text" wire:model="password" name="password" class="form-control" placeholder="Enter Password">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



