<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <h5 class="card-header">Edit Client</h5>
                <div class="card-body">
                    <div class="row">
                        <form wire:submit="updateClient" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="name">Client Name</label>
                                <input type="text" wire:model="name"  name="name" class="form-control" placeholder="Enter Client Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" wire:model="description" class="form-control" placeholder="Enter Description"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-primary">Update Client</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
