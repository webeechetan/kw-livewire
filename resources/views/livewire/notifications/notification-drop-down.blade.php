<li class="nav-item navbar-dropdown dropdown" wire:click="markAllAsRead" wire:ignore>
  <a href="#" class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);void(0);" data-bs-toggle="dropdown"
    data-bs-auto-close="outside" aria-expanded="true">
    <i class='bx bx-bell'></i>
    {{-- <span class="badge bg-danger rounded-pill badge-notifications">@if($unreadNotifications->count()) {{
      $unreadNotifications->count() }} @endif</span> --}}
  </a>
  <ul class="dropdown-menu dropdown-menu-end py-0" data-bs-popper="static">
    <li class="dropdown-menu-header">
      <div class="dropdown-header">
        <h5 class="fs-5 mb-0 me-auto">Notification</h5>
        @if(count($notifications) > 0)
          <a href="javascript:void(0);void(0)" wire:click="clearAll" class="text-decoration-underline text-danger">Clear All</a>        
        @endif
      </div>
    </li>
    <li class="activity-recent-scroll custom_scrollbar pe-0">
      <ul class="ps-0">
        @forelse ($notifications as $notification)
        <li class="border-bottom d-grid dropdown-item">
          <div class="d-flex justify-content-between cursor-pointer">
            <div class="col-auto pe-2">
              <a href="javascript:void(0);" class="avatar avatar-sm avatar-green">Sk</a>
            </div>
            <div class="team-text col">
              <div class="mb-1 text-sm">{{$notification->title}}</div>
              <span class="text-sm text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
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
        @empty
        <div class="p-4 text-center">
          <img src="{{ asset('assets/images/'.'signup_welcome.png') }}" width="80" alt="">
          <h3 class="mt-2">Woo!</h3>
          <h6 class="text-danger mb-2">No Notification</h6>
          <p>You don't have notification</p>
        </div>
        @endforelse
      </ul>
    </li>
    <!-- <li class="dropdown-footer border-top">
        <a href="" class="btn-border btn-border-sm btn-border-primary">View All Notification</a>
      </li> -->
  </ul>
</li>