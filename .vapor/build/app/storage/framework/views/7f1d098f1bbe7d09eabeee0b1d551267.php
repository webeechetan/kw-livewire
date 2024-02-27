<div class="main-body">
    <div class="main-body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="box-item">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="welcome-box">
                                    <h2 class="title">Hi <?php echo e(Auth::guard(session('guard'))->user()->name); ?>, <br /><b>Welcome back</b></h2>
                                </div>
                            </div>
                            <div class="col-md-5 text-end">
                                <div class="welcome-box-img">
                                    <img src="./assets/images/welcome-img.png" alt="Kaykewalk Welcome" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\dashboard.blade.php ENDPATH**/ ?>