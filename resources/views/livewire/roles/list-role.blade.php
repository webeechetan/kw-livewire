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
                @can('Create Role')
                    <a data-bs-toggle="modal" data-bs-target="#add-role-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i>Create Role</a>
                @endcan
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

    <div class="row mb-4">
        @foreach($roles as $role)
        <div class="col-md-3 mt-3">
            <div class=" card_style card_style-roles h-100">
                <a wire:navigate="" href="http://localhost:8000/role"class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                <div class="card_style-roles-head">
                    <p class="text-muted mb-2">Total 4 users</p>
                     <h4>
                        <a wire:navigate="" href="http://localhost:8000/role">{{$role->name}}</a>
                    </h4>
                </div>
                <div class="card_style-roles-permission">
                    <div class="card_style-roles-title mt-2"><span><i class='bx bx-universal-access'></i></span> {{ $role->permissions->count() }}  {{ $role->permissions->count() >1 ? 'Permissions' : 'Permission'}}</div>
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
    {{-- <div class="row">
        <div class="col-lg-12 mt-4">
            <h3 class="main-body-header-title mb-3">Permission</h3>
        </div>
        <div class="col-md-12">
            <div class="column-box">
                <div class="taskList-dashbaord_header">
                    <div class="row">
                        <div class="col">
                            <div class="taskList-dashbaord_header_title taskList_col">Name</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Assigned To</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Permission Date</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Action</div>
                        </div>
                    </div>
                </div>
                <div class="taskList scrollbar">
                    <div class="taskList_row" wire:key="task-row-100">
                        <div class="row">
                            <div class="col">
                              <div class="taskList_col"><span>Management</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span class="badge bg-primary">Administrator</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span class="text-nowrap">14 Apr 2021, 8:43 PM</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="taskList_row" wire:key="task-row-100">
                        <div class="row">
                            <div class="col">
                              <div class="taskList_col"><span>Billing</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span><span class="badge bg-primary">Administrator</span> <span class="badge bg-secondary">Finance</span></span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span class="text-nowrap">11 Apr 2024, 8:43 PM</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="taskList_row" wire:key="task-row-100">
                        <div class="row">
                            <div class="col">
                                <div class="taskList_col"><span>Project Planning</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span class="text-nowrap"><span class="badge bg-primary">Administrator</span> <span class="badge bg-secondary">Finance</span></span> <span class="badge bg-warning">Support</span></span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span class="text-nowrap">2 Apr 2023, 4:43 PM</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="taskList_row" wire:key="task-row-100">
                        <div class="row">
                            <div class="col">
                                <div class="taskList_col"><span>Manage Email Sequences</span></div>
                            </div>
                            <div class="col text-center">
                               <div class="taskList_col"><span class="text-nowrap"><span class="badge bg-primary">Administrator</span> <span class="badge bg-info">User</span></span> <span class="badge bg-warning">Support</span></span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span class="text-nowrap">14 Apr 2021, 8:43 PM</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="taskList_row" wire:key="task-row-100">
                        <div class="row">
                            <div class="col">
                                <div class="taskList_col"><span>Management</span></div>
                            </div>
                            <div class="col text-center">
                                 <div class="taskList_col"><span class="text-nowrap"><span class="badge bg-primary">Administrator</span> <span class="badge bg-success">Manager</span></span> <span class="badge bg-warning">Support</span></span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span class="text-nowrap">14 May 2024, 8:43 PM</span></div>
                            </div>
                            <div class="col text-center">
                                <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                            </div>
                        </div>`
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
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
