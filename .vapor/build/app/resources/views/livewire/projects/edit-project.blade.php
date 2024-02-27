<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <h5 class="card-header">Edit Project</h5>
                <div class="card-body">
                    <div class="row">
                        <form wire:submit="update" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="name">Select Client</label>
                                <select name="client_id" wire:model="client_id" class="form-control">
                                    <option value="">Select Client</option>
                                    @foreach($clients as $client)
                                        <option  value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="name">Project Name</label>
                                <input type="text" wire:model="name" name="name" class="form-control" placeholder="Enter Project Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" wire:model="description" class="form-control" placeholder="Enter Description"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <br>
                            <div>
                                <button type="submit" class="btn btn-primary">Update Project</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


