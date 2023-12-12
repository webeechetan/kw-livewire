<!DOCTYPE html>
<html lang="en">

<head>    
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

    <!-- Fav -->
    <link rel="icon" href="{{ asset('') }}assets/images/fav.png" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="{{ asset('') }}assets/css/style.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/app.css" rel="stylesheet">

    <!-- Page Init Js -->
    <script src="{{ asset('') }}assets/js/app.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @livewireStyles
    @stack('styles')
</head>

<body>
    <header class="header-main">
        <div class="header-main-wrap">
            <div class="header-main-left">
                <div class="logo">
                    <span><img src="../assets/images/logo-icon.png" alt="Kaykewalk Logo" /></span>
                    <span><img src="../assets/images/webeesocial-logo.png" alt="Webeesocial Logo" /></span>
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
                                <a id="modal-search" href="#" class="nav-link"><i class='bx bx-bell' ></i></a>
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
                    <li><a wire:navigate href="{{ route('dashboard') }}" class="@if (request()->routeIs('dashboard')) active @endif"><i class='bx bx-line-chart' ></i> Dashboard</a></li>
                    <li><a wire:navigate href="{{ route('client.index') }}" class="@if (request()->routeIs('client.index') || request()->routeIs('client.add')) active @endif"><i class='bx bx-briefcase-alt-2'></i> Clients</a></li>
                    <li><a wire:navigate href="{{ route('project.index') }}" class="@if (request()->routeIs('project.index') || request()->routeIs('project.add')) active @endif"><i class='bx bx-objects-horizontal-left'></i> Projects</a></li>
                    <li><a wire:navigate href="{{ route('user.index') }}" class="@if (request()->routeIs('user.index') || request()->routeIs('user.add')) active @endif"><i class='bx bx-user'></i> Users</a></li>
                    <li><a wire:navigate href="{{ route('team.index') }}" class="@if (request()->routeIs('team.index') || request()->routeIs('team.add')) active @endif"><i class='bx bx-sitemap'></i> Teams</a></li>
                    <li><a wire:navigate href="{{ route('task.index') }}" class="@if (request()->routeIs('task.index') || request()->routeIs('task.list-view') || request()->routeIs('task.add')) active @endif"><i class='bx bx-task' ></i> Tasks</a></li>
                </ul>
            </div>
            <div class="sidebar-l-btm">
                <img src="../assets/images/logo.png" width="150" alt="Kaykewalk Profile" />
                <p class="mb-0 mt-3">Copyright © 2023, Kaykewalk, All Rights Reserved.</p>
            </div>
        </aside>
        <div class="main-body-content">
            {{ $slot }}
            <p class="alert alert-warning" wire:offline>
                Whoops, your device has lost connection. The web page you are viewing is offline.
            </p>
        </div>
    </div>
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.4.0/dist/livewire-sortable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @stack('scripts')
    @if (session()->has('success'))
    <script>
        toastr.success('{{ session('success') }}')
    </script>
    @endif
    @if (session()->has('error'))
    <script>
        toastr.error('{{ session('error') }}')
    </script>
    @endif
</body>

</html>