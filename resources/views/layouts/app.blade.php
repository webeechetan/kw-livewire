<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Custom Styles -->
    <link href="{{ asset('') }}assets/css/app.css" rel="stylesheet">
    <!-- Page Init Js -->
    <script src="{{ asset('') }}assets/js/app.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"> @livewireStyles @stack('styles')
  </head>
  <body>
    <header class="header-main">
      <div class="header-main-wrap">
        <div class="header-main-left">
          <div class="logo">
            <span>
              <img src="{{ asset('') }}assets/images/logo-icon.png" alt="Kaykewalk Logo" />
            </span>
            <span>
              <img src="{{ asset('') }}assets/images/webeesocial-logo.png" alt="Webeesocial Logo" />
            </span>
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
                  <a id="modal-search" href="#" class="nav-link">
                    <i class='bx bx-search'></i>
                  </a>
                </li>
                <li class="nav-item navbar-dropdown dropdown">
                  <a id="modal-search" href="#" class="nav-link dropdown-toggle      hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                    <i class='bx bx-chat'></i>
                    <span class="badge bg-primary rounded-pill badge-notifications badge-message">5</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0" data-bs-popper="static">
                    <li class="dropdown-menu-header ">
                      <div class="dropdown-header">
                        <h5 class="fs-5 mb-0 me-auto">Message</h5>
                        <a href="javascript:void(0);" class="text-decoration-underline text-danger">Clear All</a>
                      </div>
                    </li>
                    <li class="activity-recent-scroll custom_scrollbar pe-0">
                      <ul class="ps-0">
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-green">Sk</a>
                            </div>
                            <div class="team-text col">
                              <h6 class="mb-1 fs-6">Sharuakh</h6>
                              <div class="mb-1 text-sm text-wrap">Won the monthly best seller gold badge</div>
                            </div>
                            <div class="col-auto">
                              <div class="text-sm text-muted">12:20 PM</div>
                              <a href="javascript:void(0);" class="dropdown-notifications-archive">
                                <span class="bx bx-x"></span>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-black">HS</a>
                            </div>
                            <div class="team-text col">
                              <h6 class="mb-1 fs-6">Himanshu Sharma</h6>
                              <div class="mb-1 text-sm text-wrap">Won the monthly best seller gold badge</div>
                            </div>
                            <div class="col-auto">
                              <div class="text-sm text-muted">12:20 PM</div>
                              <a href="javascript:void(0);" class="dropdown-notifications-archive">
                                <span class="bx bx-x"></span>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-pink">CS</a>
                            </div>
                            <div class="team-text col">
                              <h6 class="mb-1 fs-6">Chetan Singh</h6>
                              <div class="mb-1 text-sm text-wrap">Won the monthly best seller gold badge</div>
                            </div>
                            <div class="col-auto">
                              <div class="text-sm text-muted">12:20 PM</div>
                              <a href="javascript:void(0);" class="dropdown-notifications-archive">
                                <span class="bx bx-x"></span>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-blue">VM</a>
                            </div>
                            <div class="team-text col">
                              <h6 class="mb-1 fs-6">Vikram Malhotra</h6>
                              <div class="mb-1 text-sm text-wrap">Won the monthly best seller gold badge</div>
                            </div>
                            <div class="col-auto">
                              <div class="text-sm text-muted">12:20 PM</div>
                              <a href="javascript:void(0);" class="dropdown-notifications-archive">
                                <span class="bx bx-x"></span>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-green">SS</a>
                            </div>
                            <div class="team-text col">
                              <h6 class="mb-1 fs-6">Shukmhan Singh Dhillon</h6>
                              <div class="mb-1 text-sm text-wrap">Won the monthly best seller gold badge</div>
                            </div>
                            <div class="col-auto">
                              <div class="text-sm text-muted">12:20 PM</div>
                              <a href="javascript:void(0);" class="dropdown-notifications-archive">
                                <span class="bx bx-x"></span>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-yellow">DK</a>
                            </div>
                            <div class="team-text col">
                              <h6 class="mb-1 fs-6">Dinesh Kartik</h6>
                              <div class="mb-1 text-sm text-wrap">Won the monthly best seller gold badge</div>
                            </div>
                            <div class="col-auto">
                              <div class="text-sm text-muted">12:20 PM</div>
                              <a href="javascript:void(0);" class="dropdown-notifications-archive">
                                <span class="bx bx-x"></span>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-blue">VK</a>
                            </div>
                            <div class="team-text col">
                              <h6 class="mb-1 fs-6">Virat Kohli</h6>
                              <div class="mb-1 text-sm text-wrap">Won the monthly best Batsmen award by icc</div>
                            </div>
                            <div class="col-auto">
                              <div class="text-sm text-muted">12:20 PM</div>
                              <a href="javascript:void(0);" class="dropdown-notifications-archive">
                                <span class="bx bx-x"></span>
                              </a>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown-footer border-top">
                      <a href="" class="btn-border btn-border-sm btn-border-primary">View All Message</a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item navbar-dropdown dropdown">
                  <a id="modal-search" href="#" class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                    <i class='bx bx-bell'></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0" data-bs-popper="static">
                    <li class="dropdown-menu-header">
                      <div class="dropdown-header">
                        <h5 class="fs-5 mb-0 me-auto">Notification</h5>
                        <a href="javascript:void(0);void(0)" class="text-decoration-underline text-danger">Clear All</a>
                      </div>
                    </li>
                    <li class="activity-recent-scroll custom_scrollbar pe-0">
                      <ul class="ps-0">
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-green">Sk</a>
                            </div>
                            <div class="team-text col">
                              <div class="mb-1 text-sm">Won the monthly best seller gold badge</div>
                              <span class="text-sm text-muted"> 1 hr ago</span>
                            </div>
                            <div class="col-auto">
                              <div>
                                <a href="javascript:void(0);void(0)" class="dropdown-notifications-archive">
                                  <span class="bx bx-x"></span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-light">CF</a>
                            </div>
                            <div class="team-text col">
                              <div class="mb-1 text-sm">Won the monthly best seller gold badge</div>
                              <span class="text-sm text-muted">4 min ago</span>
                            </div>
                            <div class="col-auto">
                              <div>
                                <a href="javascript:void(0);void(0)" class="dropdown-notifications-archive">
                                  <span class="bx bx-x"></span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-green">HS</a>
                            </div>
                            <div class="team-text col">
                              <div class="mb-1 text-sm">Lorem ipsum dolor sit amet consectetur,.</div>
                              <span class="text-sm text-muted">2 hr ago</span>
                            </div>
                            <div class="col-auto">
                              <div>
                                <a href="javascript:void(0);void(0)" class="dropdown-notifications-archive">
                                  <span class="bx bx-x "></span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-green">Sk</a>
                            </div>
                            <div class="team-text col">
                              <div class="mb-1 text-sm">Won the monthly best seller gold badge</div>
                              <span class="text-sm text-muted">1 hr ago</span>
                            </div>
                            <div class="col-auto">
                              <div>
                                <a href="javascript:void(0);void(0)" class="dropdown-notifications-archive">
                                  <span class="bx bx-x"></span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="border-bottom d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-light">CF</a>
                            </div>
                            <div class="team-text col">
                              <div class="mb-1 text-sm">Won the monthly best seller gold badge</div>
                              <span class="text-sm text-muted"> 1min ago</span>
                            </div>
                            <div class="col-auto">
                              <div>
                                <a href="javascript:void(0);void(0)" class="dropdown-notifications-archive">
                                  <span class="bx bx-x"></span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class=" d-grid dropdown-item">
                          <div class="d-flex justify-content-between cursor-pointer">
                            <div class="col-auto pe-2">
                              <a href="javascript:void(0);" class="avatar avatar-sm avatar-green">HS</a>
                            </div>
                            <div class="team-text col">
                              <div class="mb-1 text-sm">Lorem ipsum dolor sit amet consectetur,.</div>
                              <span class="text-sm text-muted">2 hr ago</span>
                            </div>
                            <div class="col-auto">
                              <div>
                                <a href="javascript:void(0);void(0)" class="dropdown-notifications-archive">
                                  <span class="bx bx-x "></span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown-footer border-top">
                      <a href="" class="btn-border btn-border-sm btn-border-primary">View All Notification</a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item  navbar-dropdown dropdown">
                  <a id="modal-search" href="#" class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                    <span class="avatar avatar-sm avatar-green">AJ</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-setting" data-bs-popper="static">
                   <li>
                      <a href="" class="dropdown-item border-bottom">
                        <div class="flex">
                            <div class="avatar avatar-sm avatar-green">AJ</div>
                            <div class="flex-grow-1 ps-2">
                                    <span class="fw-medium d-block">Ajay Kumar</span>
                                    <small class="text-muted">Admin</small>
                            </div>
                        </div>
                      </a>
                   </li>
                    <li>
                      <a class="dropdown-item align-items-center" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item align-items-center" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item align-items-center" href="auth-login-cover.html" target="_blank">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle text-danger">Log Out</span>
                      </a>
                    </li>
                  </ul>
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
            <li>
              <a wire:navigate href="{{ route('dashboard') }}" class="@if (request()->routeIs('dashboard')) active @endif">
                <i class='bx bx-line-chart'></i> Dashboard </a>
            </li> @if (session('guard') == 'orginizations') <li>
              <a wire:navigate href="{{ route('client.index') }}" class="@if (request()->routeIs('client.index') || request()->routeIs('client.profile') || request()->routeIs('client.projects') || request()->routeIs('client.file-manager')) active @endif">
                <i class='bx bx-briefcase-alt-2'></i> Clients </a>
            </li>
            <li>
              <a wire:navigate href="{{ route('project.index') }}" class="@if (request()->segment(1) == 'projects' || request()->segment(1) == 'project' ) active @endif">
                <i class='bx bx-objects-horizontal-left'></i> Projects </a>
            </li>
            <li>
              <a wire:navigate href="{{ route('user.index') }}" class="@if (request()->routeIs('user.index') || request()->routeIs('user.add')) active @endif">
                <i class='bx bx-user'></i> Users </a>
            </li>
            <li>
              <a wire:navigate href="{{ route('team.index') }}" class="@if (request()->routeIs('team.index') || request()->routeIs('team.add')) active @endif">
                <i class='bx bx-sitemap'></i> Teams </a>
            </li>
            <li>
              <a wire:navigate href="{{ route('role.index') }}" class="@if (request()->segment(1) == 'roles' || request()->segment(1) == 'role' ) active @endif">
                <i class='bx bx-sitemap'></i> Role & Permissions </a>
            </li> @endif <li>
              <a wire:navigate href="{{ route('task.index') }}" class="@if (request()->routeIs('task.index') || request()->routeIs('task.list-view') || request()->routeIs('task.add')) active @endif">
                <i class='bx bx-task'></i> Tasks </a>
            </li>
          </ul>
        </div>
        <div class="sidebar-l-btm">
          <img src="{{ asset('') }}assets/images/logo.png" width="150" alt="Kaykewalk Profile" />
          <p class="mb-0 mt-3">Copyright © 2024, Kaykewalk, All Rights Reserved.</p>
        </div>
      </aside>
      <div class="main-body-content">
        {{ $slot }}
        <p class="alert alert-warning" wire:offline> Whoops, your device has lost connection. The web page you are viewing is offline. </p>
      </div>
    </div>
    {{-- <livewire:components.voice-control /> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.4.0/dist/livewire-sortable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.0/annyang.min.js"></script> @livewireScripts @stack('scripts') @if (session()->has('success')) <script>
      toastr.success("{{ session('success') }}")
    </script> @endif @if (session()->has('error')) <script>
      toastr.error("{{ session('error') }}")
    </script> @endif <script>
      document.addEventListener('error', event => {
        toastr.remove()
        toastr.error(event.detail)
      })
      document.addEventListener('success', event => {
        toastr.remove();
        toastr.success(event.detail)
      })
      $('.cus_dropdown-icon').click(function() {
        $(this).parent('.cus_dropdown').toggleClass('open');
      });
      $('.cus_dropdown-icon, .filterSort').click(function() {
        event.stopPropagation();
      });
      $('html').click(function() {
        $('.cus_dropdown').removeClass('open');
      });
      document.addEventListener('livewire:navigated', () => {
        setTimeout(() => {
          $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
          })
        }, 1000);
      });
    </script>
  </body>
</html>