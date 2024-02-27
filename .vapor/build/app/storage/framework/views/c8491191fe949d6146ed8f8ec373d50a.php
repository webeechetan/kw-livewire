<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Users</li>
        </ol>
    </nav>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Users</h3>
                <span class="text-light">|</span>
                <a data-bs-toggle="modal" data-bs-target="#add-user-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add User</a>
                <!-- <a wire:navigate href="<?php echo e(route('user.add')); ?>" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add User</a> -->
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Users...">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                    <div class="main-body-header-filters">
                        <div class="cus_dropdown">
                            <div class="cus_dropdown-icon btn-border btn-border-secondary"><i class='bx bx-filter-alt' ></i> Filter</div>
                            <div class="cus_dropdown-body cus_dropdown-body-widh_l">
                                <div class="cus_dropdown-body-wrap">
                                    <div class="filterSort">
                                        <h5 class="filterSort-header"><i class='bx bx-sort-down text-primary' ></i> Sort By</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Newest</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch"><i class='bx bx-down-arrow-alt' ></i> A To Z</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch"><i class='bx bx-up-arrow-alt' ></i> Z To A</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Status</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Active</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Archived</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                                        <select class="form-control"name="" id="">
                                            <option value="Rakesh">Rakesh</option>
                                            <option value="Rajiv">Rajiv</option>
                                        </select>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By Projects</h5>
                                        <select class="form-control"name="" id="">
                                            <option value="Rakesh">Tech Team</option>
                                            <option value="Rajiv">Copy Team</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">        
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card_style card_style-user h-100">
                    <!-- Edit -->
                    <div class="cus_dropdown cus_dropdown-edit">
                        <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a href="#"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                    <li><a href="#"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card_style-user-head">
                        <div class="card_style-user-profile-img"><span><img src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($user->image); ?>" alt="<?php echo e($user->name); ?>"></span></div>
                        <div class="card_style-user-profile-content">
                            <h4><a wire:navigate href="<?php echo e(route('user.profile')); ?>"><?php echo e($user->name); ?></a></h4>
                            <div class="d-flex align-items-center"><i class='bx bx-envelope me-1 text-secondary' ></i> <?php echo e($user->email); ?></div>
                            <div class="card_style-user-head-position mt-2"><i class='bx bx-user'></i> Web Developer | Tech Team</div>
                            <div class="mt-2">Assigned <span class="btn-batch btn-batch-warning">5 Teams</span></div>
                        </div>
                    </div>
                    <hr>
                    <div class="card_style-user-body">
                        <div class="card_style-options">
                            <div class="card_style-options-head"><span><i class='bx bx-layer text-secondary' ></i></span> 30 Projects <span class="text-dark-grey ms-1">|</span> 5 Clients</div>
                            <div class="card_style-options-list d-flex">
                                <div class="text-primary">Active <span class="btn-batch-bg btn-batch-bg-primary">10 Projects</span></div>
                                <div class="text-success ms-4">Completed <span class="btn-batch-bg btn-batch-bg-success">5 Projects</span></div>
                            </div>
                        </div>
                        <hr>
                        <div class="card_style-tasks">
                            <div class="card_style-tasks-title"><span><i class='bx bx-objects-horizontal-left' ></i></span> 60 Tasks</div>
                            <div class="card_style-tasks-list">
                                <div class="card_style-tasks-item card_style-tasks-item-pending"><span><i class='bx bx-objects-horizontal-center' ></i></span> 30 Active</div>
                                <div class="card_style-tasks-item card_style-tasks-item-overdue"><span><i class='bx bx-objects-horizontal-center' ></i></span> 20 Overdue</div>
                                <div class="card_style-tasks-item card_style-tasks-item-done"><span><i class='bx bx-objects-horizontal-center' ></i></span> 10 Completed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="pagintaions mt-4">
            <?php echo e($users->links(data: ['scrollTo' => false])); ?>

        </div>
    </div>

    <!-- User Modal -->
    <div wire:ignore class="modal fade" id="add-user-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-user' ></i></span> Add User</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="title-sm title-with_icon"><i class='bx bx-mail-send text-secondary' ></i> Invite User</h5>
                                </div>
                                <div class="col-lg mb-4 mb-lg-0">
                                    <div class="single-add">
                                        <div class="single-add-wrap">
                                            <input wire:model="project_name" type="text" class="form-control" placeholder="Email Here..."> 
                                        </div>
                                        <button type="submit" class="btn-border btn-border-secondary"><i class='bx bx-send' ></i> Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="divider-or"><span></span> OR <span></span></div>
                    <form wire:submit="addProject" method="POST" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">User Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="project_name" type="text" class="form-style" placeholder="User Name Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Designation<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="project_name" type="text" class="form-style" placeholder="Designation Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Email<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input  type="email" class="form-style" placeholder="Email Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Password<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input type="text" class="form-style" placeholder="Password Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4 mb-lg-0">
                                    <label for="">Team<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8">
                                    <select name="" id="">
                                        <option value="">Rakesh</option>
                                        <option value="">Rajiv</option>
                                        <option value="">Akash</option>
                                    </select>
                                </div>
                            </div>                            
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary">Add Project</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\users\list-user.blade.php ENDPATH**/ ?>