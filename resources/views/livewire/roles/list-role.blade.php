<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Webeesocial</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Roles</li>
        </ol>
    </nav>

    <div class="dashboard-head mb-4">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">Roles</h3>
                <span class="text-light">|</span>
                <a data-bs-toggle="modal" data-bs-target="#add-role-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i>Create Role</a>
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Company">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($roles as $role)
        <div class="col-md-4 mb-4">
            <div class=" card_style card_style-roles h-100">
                <a href="" class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                <div class="card_style-roles-head">
                    <p class="text-muted">Total 4 users</p>
                     <h4>
                        <a wire:navigate="" href="http://localhost:8000/role">{{$role->name}}</a>
                    </h4>
                </div>
                <div class="card_style-roles-permission">
                        <div class="card_style-roles-title mt-2"><span><i class='bx bx-universal-access'></i></span> {{ $role->permissions->count() }} Permissions</div>
                        <div class="mt-2">
                          <a class="edit-role" wire:click="emitEditRoleEvent({{$role->id}})"> Edit Role</a>
                         </div>
                        <!-- <div class="card_style-roles-list justify-content-center"> -->
                           @foreach($role->permissions as $permission)
                                <!-- <div class="card_style-roles-items card_style-roles-permissions">{{ $permission->name }}</div> -->
                            @endforeach
                        <!-- </div> -->
                        
                </div>
              
              
              
            </div>
        </div>
        @endforeach
    </div>

    <livewire:components.add-role  @saved="$refresh" />
</div>

@script
    <script>
        window.addEventListener('role-added', event => {
            toastr.success(event.detail.message, 'Success');
            location.reload();
        });

        window.addEventListener('edit-role', event => {
            console.log('edit');
            $('.role-form-text').text('Edit Role');
            $('.role-form-btn').text('Update Role');
            $('#add-role-modal').modal('show');
        });

        window.addEventListener('role-updated', event => {
            toastr.success(event.detail.message, 'Success');
            location.reload();
        });
    </script>
@endscript
