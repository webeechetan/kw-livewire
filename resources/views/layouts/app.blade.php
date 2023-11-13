<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="{{ asset('') }}assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{ asset('') }}assets/js/app.js"></script>
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
                                <a id="modal-search" href="#" class="nav-link" ><SearchOutlinedIcon/></a>
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
                    <li><a wire:navigate href="{{ route('dashboard') }}" class="@if (request()->routeIs('dashboard')) active @endif"><HomeOutlinedIcon/> Dashboard</a></li>
                    <li><a wire:navigate href="{{ route('client.index') }}" class="@if (request()->routeIs('client.index') || request()->routeIs('client.add')) active @endif"><PeopleAltOutlinedIcon/> Clients</a></li>
                    <li><a wire:navigate href="{{ route('project.index') }}" class="@if (request()->routeIs('project.index') || request()->routeIs('project.add')) active @endif"><DashboardOutlinedIcon/> Projects</a></li>
                    <li><a wire:navigate href="{{ route('user.index') }}" class="@if (request()->routeIs('user.index') || request()->routeIs('user.add')) active @endif"><PeopleAltOutlinedIcon/> Users</a></li>
                    <li><a wire:navigate href="{{ route('team.index') }}" class="@if (request()->routeIs('team.index') || request()->routeIs('team.add')) active @endif"><GroupOutlinedIcon/> Teams</a></li>
                    <li><a wire:navigate href="{{ route('task.index') }}" class="@if (request()->routeIs('task.index') || request()->routeIs('task.add')) active @endif"><AssignmentOutlinedIcon /> Tasks</a></li>
                </ul>
            </div>
            <div class="sidebar-l-btm">
                <img src="../assets/images/logo.png" width="150" alt="Kaykewalk Profile" />
                <p class="mb-0 mt-3">Copyright © 2023, Kaykewalk, All Rights Reserved.</p>
            </div>
        </aside>
        <div class="main-body-content">
            {{ $slot }}
        </div>
    </div>
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}


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