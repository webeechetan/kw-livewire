<div>
    <div class="dashboard-head pb-0 mb-4">
        <div class="row align-items-center">
            <div class="col">
                <div class="dashboard-head-title-wrap">
                    
                        <div class="avatar avatar-lg">
                            <img src="" alt="Avatar" class="avatar-img rounded-circle">
                        </div>
                   
                        <div class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="">initials</div>
                   
                    <div>
                        <h3 class="main-body-header-title mb-2">static name</h3>
                        <div class="text-sm text-uppercase">static client name</div>
                    </div>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <!-- Edit -->
                    <div class="cus_dropdown">

                      
                            <div class="cus_dropdown-icon btn-border btn-border-danger">Archived <i class='bx bx-chevron-down'></i></div>
                       
                            <div class="cus_dropdown-icon btn-border btn-border-success">Completed <i class='bx bx-chevron-down'></i></div>
                       
                            <div class="cus_dropdown-icon btn-border btn-border-success">Active <i class='bx bx-chevron-down'></i></div>
                       

                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a href="javascript:" wire:click=""  class="active">Active</a></li>
                                    <li><a href="javascript:" wire:click=""  class="active">Completed</a></li>
                                    <li><a href="javascript:" wire:click="" class="active"> Archived</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:" wire:click="" class="btn-sm btn-border btn-border-secondary">
                        <span wire:loading wire:target="emitEditProjectEvent">
                            <i class='bx bx-loader-alt bx-spin'></i>
                        </span>
                        <i class='bx bx-pencil'></i> 
                        Edit
                    </a>
                    
                    @can('Delete Project')
                    <a href="javascript:" wire:click="" wire:confirm="Are you sure you want to delete?" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a>
                    @endcan
                </div>
            </div>
        </div>
        <hr class="mb-0">
        <div class="tabNavigationBar-tab border_style">
           
            <a wire:navigate class="tabNavigationBar-item" href=""><i class='bx bx-line-chart'></i> Overview</a>
            <a wire:navigate class="tabNavigationBar-item" href=""><i class='bx bx-layer' ></i> Tasks</a>
            <a wire:navigate class="tabNavigationBar-item" href=""><i class='bx bx-objects-horizontal-left' ></i> File Manager</a>
        </div>
    </div>
    <livewire:components.add-activity @saved="$refresh" />
</div>
