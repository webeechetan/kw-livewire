<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <h5 class="card-header">Add User</h5>
                
                <div class="card-body">
                    <div class="row">
                        <form wire:submit.prevent="inviteUser" method="POST">
                            <div class="col-md-12">
                                <label for="email">Email</label>
                                <input type="text" wire:model="email" name="email" class="form-control" placeholder="Enter Email">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Invite User</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form wire:submit="store" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="name">User Name</label>
                                <input type="text" wire:model="name" name="name" class="form-control" placeholder="Enter Client Name">
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
                                <label for="email">Email</label>
                                <input type="text" wire:model="email" name="email" class="form-control" placeholder="Enter Email">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="password">Password</label>
                                <input type="text" wire:model="password" name="password" class="form-control" placeholder="Enter Password">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="profile">Profile</label>
                                <input type="file" wire:model="image" class="form-control">
                            </div>

                            <div class="col-md-12 mt-3" wire:ignore>
                                <label for="teams">Teams</label>
                                <select class="form-control teams" multiple>
                                    <option value="">Select Project</option>
                                    <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($team->id); ?>"><?php echo e($team->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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

<?php $__env->startPush('scripts'); ?>
    <script>
        $('.teams').select2();

        $('.teams').on('change', function(e){
            var teams = $('.teams');
            var selected_teams = teams.val();
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('team_ids', selected_teams);
        });
    </script>
<?php $__env->stopPush(); ?>



<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\users\add-user.blade.php ENDPATH**/ ?>