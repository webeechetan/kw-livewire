<!DOCTYPE html>
<html lang="en">

<head>    
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? 'Dashboard'); ?></title>

    <!-- Fav -->
    <link rel="icon" href="<?php echo e(asset('')); ?>assets/images/fav.png" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Custom Styles -->
    <link href="<?php echo e(asset('')); ?>assets/css/app.css" rel="stylesheet">

    <!-- Page Init Js -->
    <script src="<?php echo e(asset('')); ?>assets/js/app.js"></script>  

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <header class="header-main">
        <div class="header-main-wrap">
            <div class="header-main-left">
                <div class="logo">
                    <span><img src="<?php echo e(asset('')); ?>assets/images/logo-icon.png" alt="Kaykewalk Logo" /></span>
                    <span><img src="<?php echo e(asset('')); ?>assets/images/webeesocial-logo.png" alt="Webeesocial Logo" /></span>
                </div>
            </div>
            <div class="header-main-right">
                <!-- Header Menu -->
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive-navbar-nav" aria-controls="responsive-navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="responsive-navbar-nav">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item">
                                <a id="modal-search" href="#" class="nav-link"><i class='bx bx-search'></i></a>
                            </li>
                            <li class="nav-item">
                                <a id="modal-search" href="#" class="nav-link"><i class='bx bx-chat'></i></a>
                            </li>
                            <li class="nav-item">
                                <a id="modal-search" href="#" class="nav-link"><i class='bx bx-bell' ></i></a>
                            </li>
                            <li class="nav-item">
                                <a id="modal-search" href="#" class="nav-link">
                                    <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajay Kumar">
                                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle">
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="main-body">
        <aside class="sidebar-l">
            <div class="sidebar-l-menu">
                <ul class="list-none menu-sidebar">
                    <li><a wire:navigate href="<?php echo e(route('dashboard')); ?>" class="<?php if(request()->routeIs('dashboard')): ?> active <?php endif; ?>"><i class='bx bx-line-chart' ></i> Dashboard</a></li>
                    <?php if(session('guard') == 'orginizations'): ?>
                        <li><a wire:navigate href="<?php echo e(route('client.index')); ?>" class="<?php if(request()->routeIs('client.index') || request()->routeIs('client.profile')): ?> active <?php endif; ?>"><i class='bx bx-briefcase-alt-2'></i> Clients</a></li>
                        <li><a wire:navigate href="<?php echo e(route('project.index')); ?>" class="<?php if(request()->routeIs('project.index') || request()->routeIs('project.profile')): ?> active <?php endif; ?>"><i class='bx bx-objects-horizontal-left'></i> Projects</a></li>
                        <li><a wire:navigate href="<?php echo e(route('user.index')); ?>" class="<?php if(request()->routeIs('user.index') || request()->routeIs('user.add')): ?> active <?php endif; ?>"><i class='bx bx-user'></i> Users</a></li>
                        <li><a wire:navigate href="<?php echo e(route('team.index')); ?>" class="<?php if(request()->routeIs('team.index') || request()->routeIs('team.add')): ?> active <?php endif; ?>"><i class='bx bx-sitemap'></i> Teams</a></li>
                    <?php endif; ?>
                    <li><a wire:navigate href="<?php echo e(route('task.index')); ?>" class="<?php if(request()->routeIs('task.index') || request()->routeIs('task.list-view') || request()->routeIs('task.add')): ?> active <?php endif; ?>"><i class='bx bx-task' ></i> Tasks</a></li>
                    <li><a href="<?php echo e(route('file-manager')); ?>" class="<?php if(request()->routeIs('file-manager')): ?> active <?php endif; ?>"><i class='bx bx-file' ></i> Files</a></li>
                </ul>
            </div>
            <div class="sidebar-l-btm">
                <img src="<?php echo e(asset('')); ?>assets/images/logo.png" width="150" alt="Kaykewalk Profile" />
                <p class="mb-0 mt-3">Copyright © 2024, Kaykewalk, All Rights Reserved.</p>
            </div>
        </aside>
        <div class="main-body-content">
            <?php echo e($slot); ?>

            <p class="alert alert-warning" wire:offline>
                Whoops, your device has lost connection. The web page you are viewing is offline.
            </p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.4.0/dist/livewire-sortable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php if(session()->has('success')): ?>
    <script>
        toastr.success("<?php echo e(session('success')); ?>")
    </script>
    <?php endif; ?>
    <?php if(session()->has('error')): ?>
    <script>
        toastr.error("<?php echo e(session('error')); ?>")
    </script>
    <?php endif; ?>

    <script>
        document.addEventListener('error', event => {
            toastr.clear()
            toastr.error(event.detail)
        })

        document.addEventListener('success', event => {
            // remove all toasts
            toastr.clear()
            toastr.success(event.detail)
        })
        $('.cus_dropdown-icon').click(function(){
            $(this).parent('.cus_dropdown').toggleClass('open');
        });

        $('.cus_dropdown-icon, .filterSort').click(function(){
            event.stopPropagation();
        });

        $('html').click(function(){
            $('.cus_dropdown').removeClass('open');
        });

        document.addEventListener('livewire:navigated', () => {
            setTimeout(() => {
                $(function () {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                })
            }, 1000);
        });
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\layouts\app.blade.php ENDPATH**/ ?>