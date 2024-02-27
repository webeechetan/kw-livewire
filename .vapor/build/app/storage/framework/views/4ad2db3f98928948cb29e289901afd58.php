<div class="signin-content">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 text-center px-0">
                <div class="signin-content-left bg-md-secondary">
                    <img class="img-fluid d-none d-md-block" src="./assets/images/logo-verticle-white.png" alt="Kaykewalk White Logo" />
                    <img class="img-fluid d-md-none" src="./assets/images/logo.png" alt="Kaykewalk Logo" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="signin-content-right text-center text-md-start space-sec">
                    <div class="signin-content-right-top">
                        <h2 class="title">Reset your password</h2>
                    </div>
                    <div class="signin-content-right-btm mt-4">
                        <?php if($step == 1): ?>
                        <form wire:submit="sendOTP" method="POST">
                            <div class="mb-3" >
                                <div class="form-field">
                                    <div class="form-field-icon">
                                        <i class='bx bx-envelope'></i>
                                    </div>
                                    <input type="email" wire:model="email" class="form-control" placeholder="Enter Email" required />
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <?php if(session()->has('error')): ?>
                                <div class="col text-center">
                                    <div class="text-danger">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-12 mb-4">
                                <button class="w-100 btn btn-primary" type="submit">Send OTP</button>
                            </div>
                            <div class="col-12 text-center">
                                <a wire:navigate href="<?php echo e(route('login')); ?>" class="text-link">Back to Login</a>
                            </div>
                        </form>

                        <?php endif; ?>
                        
                        <?php if($step == 2): ?>
                        <form wire:submit="verifyOTP" method="POST">
                            <div class="mb-3" >
                                <div class="form-field">
                                    <div class="form-field-icon">
                                        <i class='bx bx-envelope'></i>
                                    </div>
                                    <input type="text" wire:model="enterdOTP" class="form-control" placeholder="Enter OTP" required />
                                    <?php $__errorArgs = ['enterdOTP'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <?php if(session()->has('error')): ?>
                                <div class="col text-center">
                                    <div class="text-danger">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="mt-2">
                                <div class="col">
                                    <button class="w-100 btn btn-primary" type="submit">Verify OTP</button>
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>

                        <?php if($step == 3): ?>
                        <form wire:submit="changePassword" method="POST">
                            <div class="mb-3" >
                                <div class="form-field">
                                    <div class="form-field-icon">
                                        <i class='bx bx-lock-open'></i>
                                    </div>
                                    <input type="text" wire:model="password" class="form-control" placeholder="Enter Password" required />
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-field">
                                    <div class="form-field-icon">
                                        <i class='bx bx-lock-open'></i>
                                    </div>
                                    <input type="text" wire:model="password_confirmation" class="form-control" placeholder="Confirm Password" required />
                                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <?php if(session()->has('success')): ?>
                                <div class="col text-center">
                                    <div class="text-success">
                                        <?php echo e(session('success')); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="mt-2">
                                <div class="col">
                                    <button class="w-100 btn btn-primary" type="submit">Change Password</button>
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\forgot-password.blade.php ENDPATH**/ ?>