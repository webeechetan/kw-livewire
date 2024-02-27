<div class="container">
    <!-- Dashboard Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-start">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a wire:navigate href="<?php echo e(route('dashboard')); ?>"><i class='bx bx-line-chart'></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Clients</li>
            </ol>
        </nav>
        
    </div>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Clients</h3>
                <span class="text-light">|</span>
                <a data-bs-toggle="modal" data-bs-target="#add-client-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Client</a>
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Clients...">
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
                                            <li class="filterSort_item">
                                                <a wire:navigate href="<?php echo e(route('client.index',['sort'=>'newest','filter'=>$filter])); ?>" class="btn-batch  <?php if($sort == 'newest'): ?> active <?php endif; ?>" >Newest</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="<?php echo e(route('client.index',['sort'=>'a_z','filter'=>$filter])); ?>" class="btn-batch  <?php if($sort == 'a_z'): ?> active <?php endif; ?>"><i class='bx bx-down-arrow-alt' ></i> A To Z</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="<?php echo e(route('client.index',['sort'=>'z_a','filter'=>$filter])); ?>" class="btn-batch  <?php if($sort == 'z_a'): ?> active <?php endif; ?>"><i class='bx bx-up-arrow-alt' ></i> Z To A</a>
                                            </li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('client.index',['sort'=>$sort,'filter'=>'active'])); ?>" class="btn-batch  <?php if($filter == 'active'): ?> active <?php endif; ?>">Active</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('client.index',['sort'=>$sort,'filter'=>'completed'])); ?>" class="btn-batch  <?php if($filter == 'completed'): ?> active <?php endif; ?>">Completed</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('client.index',['sort'=>$sort,'filter'=>'archived'])); ?>" class="btn-batch  <?php if($filter == 'archived'): ?> active <?php endif; ?>">Archived</a></li>
                                        </ul>
                                        
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
        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $activeProjects = $client->projects->where('status', 'active');
            $completedProjects = $client->projects->where('status', 'completed');
        ?>
        <div class="col-md-4 mb-4"  wire:key="<?php echo e($client->id); ?>">
            <div class="card_style card_style-client h-100">
                <div wire:loading wire:target="emitDeleteEvent(<?php echo e($client->id); ?>)" class="card_style-loader">
                    <div class="card_style-loader-wrap"><i class='bx bx-trash text-danger me-2' ></i> Removing ...</div>
                </div>
                <!-- Edit -->
                <div class="cus_dropdown cus_dropdown-edit">
                    <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                    <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                        <div class="cus_dropdown-body-wrap">
                            <ul class="cus_dropdown-list">
                                <?php if($client->trashed()): ?>
                                    <li><a href="javascript:" wire:click="emitRestoreEvent(<?php echo e($client->id); ?>)"><span class="text-danger"><i class='bx bx-recycle'></i></span> Restore</a></li>
                                    <li><a href="javascript:" wire:click="emitForceDeleteEvent(<?php echo e($client->id); ?>)"><span class="text-danger"><i class='bx bx-trash'></i></span> Permanent Delete</a></li>
                                <?php else: ?>
                                    <li class="edit_client" wire:click="emitEditEvent(<?php echo e($client->id); ?>)"><a href="javascript:"><span class="text-secondary "><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                    <li><a href="javascript:" wire:click="emitDeleteEvent(<?php echo e($client->id); ?>)"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card_style-client-head">
                    <div><img src="<?php echo e(asset('storage/'.$client->image)); ?>" alt="" class="img-fluid"></div>
                    <div>
                        <h4><a wire:navigate href="<?php echo e(route('client.profile', $client->id )); ?>"><?php echo e($client->name); ?></a></h4>
                        <div class="btn-withIcon"><i class='bx bx-layer text-secondary' ></i> <?php echo e($client->projects->count()); ?> Projects</div>
                    </div>
                </div>
                <div class="card_style-client-body">
                    <div class="card_style-projects_tab">
                        <ul class="nav nav-pills mb-2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <div class="card_style-projects_tab-title active text-primary"  data-bs-toggle="pill" data-bs-target="#active-<?php echo e($client->id); ?>" role="tab" aria-controls="pills-home" aria-selected="true">Active <span class="btn-batch-bg btn-batch-bg ms-2"><?php echo e(count($activeProjects)); ?> Projects</span></div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <div class="card_style-projects_tab-title text-success" data-bs-toggle="pill" data-bs-target="#completed-<?php echo e($client->id); ?>" role="tab" aria-controls="pills-profile" aria-selected="false">Completed <span class="btn-batch-bg btn-batch-bg-success ms-2"><?php echo e(count($completedProjects)); ?> Projects</span></div>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="active-<?php echo e($client->id); ?>" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="card_style-projects_tab-items">
                                    <!-- Avatar Group (Add + More option after 6) -->
                                    <div class="avatarGroup avatarGroup-lg mt-2">
                                        <?php
                                            $plus_more_projects = 0;
                                            if(count($activeProjects) > 7){
                                                $plus_more_projects = count($activeProjects) - 7;
                                            }
                                        ?>
                                        <?php $__currentLoopData = $activeProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($loop->index < 7): ?>
                                                <a href="#" class="avatarGroup-avatar">
                                                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo e($project->name); ?>">
                                                        <img alt="avatar" src="<?php echo e(asset('storage/'.$project->image)); ?>" class="rounded-circle">
                                                    </span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($plus_more_projects > 0): ?>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-more" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo e($plus_more_projects); ?> more projects">
                                                    <span class="avatar-more-text">+<?php echo e($plus_more_projects); ?></span>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="completed-<?php echo e($client->id); ?>" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="card_style-projects_tab-items">
                                    <!-- Avatar Group (Add + More option after 6) -->
                                    <div class="avatarGroup avatarGroup-lg mt-2">
                                        <?php $__currentLoopData = $completedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo e($project->name); ?>">
                                                <img alt="avatar" src="<?php echo e(asset('storage/'.$project->image)); ?>" class="rounded-circle">
                                            </span>
                                        </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="pagintaions mt-4">
            <?php echo e($clients->links(data: ['scrollTo' => false])); ?>

        </div>
    </div>

    <!-- Client Modal Component -->
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.add-client', ['@saved' => '$refresh']);

$__html = app('livewire')->mount($__name, $__params, 'IqzAy3n', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</div>
<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\clients\list-client.blade.php ENDPATH**/ ?>