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
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-12">
                                <label for="name">Client Image</label>
                                <input type="file" wire:model="image" name="image" class="form-control">
                                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <img src="<?php echo e(asset('storage/'.$client->image)); ?>" alt="" height="100" width="100">
                            </div>
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" wire:model="description" class="form-control" placeholder="Enter Description"></textarea>
                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\clients\edit-client.blade.php ENDPATH**/ ?>