<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <h5 class="card-header">Add Team</h5>
                <div class="card-body">
                    <div class="row">
                        <form wire:submit="store" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="name">Team Name</label>
                                <input type="text" wire:model="name" name="name" class="form-control" placeholder="Enter Team Name">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="description">Team Description</label>
                                <textarea wire:model="description" name="description" class="form-control" placeholder="Enter Team Description"></textarea>
                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-12 mt-3" wire:ignore>
                                <label for="users">Users</label>
                                <select class="form-control users" multiple>
                                    <option value="">Select User</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Add Team</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        $('.users').select2();

        $('.users').on('change', function(e){
            var users = $('.users');
            var selected_users = users.val();
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('user_ids', selected_users);
        });
    </script>
<?php $__env->stopPush(); ?>




<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\teams\add-team.blade.php ENDPATH**/ ?>