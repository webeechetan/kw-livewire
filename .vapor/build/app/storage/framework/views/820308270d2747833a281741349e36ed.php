<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Projects</li>
        </ol>
    </nav>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Projects</h3>
                <span class="text-light">|</span>
                <a data-bs-toggle="modal" data-bs-target="#add-project-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Project</a>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Projects...">
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
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('project.index',['sort'=>'newest','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])); ?>" class="btn-batch  <?php if($sort == 'newest'): ?> active <?php endif; ?>">Newest</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('project.index',['sort'=>'oldest','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])); ?>" class="btn-batch  <?php if($sort == 'oldest'): ?> active <?php endif; ?>">Oldest</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('project.index',['sort'=>'a_z','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])); ?>" class="btn-batch  <?php if($sort == 'a_z'): ?> active <?php endif; ?>"><i class='bx bx-down-arrow-alt' ></i> A To Z</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('project.index',['sort'=>'z_a','filter'=>$filter,'byUser'=>$byUser, 'byTeam' => $byTeam])); ?>" class="btn-batch  <?php if($sort == 'z_a'): ?> active <?php endif; ?>"><i class='bx bx-up-arrow-alt' ></i> Z To A</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Status</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('project.index',['sort'=>$sort,'filter'=>'active','byUser'=>$byUser, 'byTeam' => $byTeam])); ?>" class="btn-batch  <?php if($filter == 'active'): ?> active <?php endif; ?>">Active</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('project.index',['sort'=>$sort,'filter'=>'overdue','byUser'=>$byUser, 'byTeam' => $byTeam])); ?>" class="btn-batch  <?php if($filter == 'overdue'): ?> active <?php endif; ?>">Overdue</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('project.index',['sort'=>$sort,'filter'=>'completed','byUser'=>$byUser, 'byTeam' => $byTeam])); ?>" class="btn-batch  <?php if($filter == 'completed'): ?> active <?php endif; ?>">Completed</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="<?php echo e(route('project.index',['sort'=>$sort,'filter'=>'archived','byUser'=>$byUser, 'byTeam' => $byTeam])); ?>" class="btn-batch  <?php if($filter == 'archived'): ?> active <?php endif; ?>">Archived</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By User</h5>
                                        <select class="form-control" wire:model.live="byUser">
                                            <option value="all">All</option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                                        <select class="form-control"name="" id="">
                                            <option value="Rakesh">Rakesh</option>
                                            <option value="Rajiv">Rajiv</option>
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
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mt-4">
                <div class="card_style card_style-overdue">
                    <!-- Edit -->
                    <div class="cus_dropdown cus_dropdown-edit">
                        <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a wire:click="emitEditEvent(<?php echo e($project->id); ?>)"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                    <li><a wire:confirm="Are you sure you want to delete this project?" wire:click="emitDeleteEvent(<?php echo e($project->id); ?>)"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card_style-project-head">
                
                        <h4><a href="<?php echo e(route('project.profile',$project->id)); ?>" wire:navigate><?php echo e($project->name); ?></a></h4>
                        <!-- Avatar Group -->
                        <div class="avatarGroup avatarGroup-lg avatarGroup-overlap mt-2">
                            <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="#" class="avatarGroup-avatar">
                                    <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>">
                                        <img alt="avatar" src="<?php echo e(asset('storage/'.$user->image)); ?>" class="rounded-circle">
                                    </span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </div>
                    </div>
                    <div class="card_style-project-body card_style-overdue">
                        <div class="card_style-project-options">
                            <div><span><i class='bx bx-layer' ></i></span> 5 Attachements</div>
                            <div><span><i class='bx bx-calendar' ></i></span> <?php echo e(\Carbon\Carbon::parse($project->due_date)->diffInDays($project->start_date)); ?> Days</div>
                        </div>
                        <hr>
                        <div class="card_style-tasks">
                            <div class="card_style-tasks-title"><span><i class='bx bx-objects-horizontal-left' ></i></span> <?php echo e($project->tasks->count()); ?> Tasks</div>
                            <div class="card_style-tasks-list">
                                <div class="card_style-tasks-item card_style-tasks-item-pending"><span><i class='bx bx-objects-horizontal-center' ></i></span>
                                    <?php echo e($project->tasks->where('status', 'pending')->count()); ?> Active
                                </div>
                                <div class="card_style-tasks-item card_style-tasks-item-overdue"><span><i class='bx bx-objects-horizontal-center' ></i></span> 
                                    <?php echo e($project->tasks->where('due_date', '<', now())->count()); ?> Overdue
                                </div>
                                <div class="card_style-tasks-item card_style-tasks-item-done"><span><i class='bx bx-objects-horizontal-center' ></i></span>
                                    <?php echo e($project->tasks->where('status', 'completed')->count()); ?> Completed
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="task_progress ">
                            <div class="task_progress-head">
                                <div class="task_progress-head-title">Progress</div>
                                <div class="task_progress-head-days"><span><i class='bx bx-calendar-minus'></i></span> 
                                    <?php
                                        $days = \Carbon\Carbon::parse($project->due_date)->diffInDays(now());
                                    ?>
                                    <?php if($days > 0 && $project->due_date > now()): ?>
                                        <?php echo e($days); ?> Days Left
                                    <?php elseif($days == 0): ?>
                                        Today
                                    <?php else: ?>
                                        <?php echo e(abs($days)); ?> Days Overdue
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="task_progress-btm">
                                <div class="progress" role="progressbar" aria-label="Project Progress" aria-valuemin="0" aria-valuemax="100">
                                    <?php
                                        $percentage = 0;
                                        $completed = $project->tasks->where('status', 'completed')->count();
                                        $total = $project->tasks->count();
                                        if($total > 0){
                                            $percentage = ($completed / $total) * 100;  
                                        }else{
                                            $percentage = 0;
                                        }
                                    ?>
                                    <div class="progress-bar progress-success" style="width: <?php echo e($percentage); ?>%"><span class="progress-bar-text"><?php echo e($percentage); ?>%</span></div>

                                </div>
                                <div class="task_progress-btm-date d-flex justify-content-between">
                                    <div><i class='bx bx-calendar text-primary' ></i> <?php echo e(\Carbon\Carbon::parse($project->start_date)->format('d M,Y')); ?></div>
                                    <div class="text-success"><i class='bx bx-calendar-check ' ></i> <?php echo e(\Carbon\Carbon::parse($project->due_date)->format('d M,Y')); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="pagintaions mt-4">
            <?php echo e($projects->links(data: ['scrollTo' => false])); ?>

        </div>
    </div>
    
    <!-- Add Project Component -->
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.add-project', ['@saved' => '$refresh']);

$__html = app('livewire')->mount($__name, $__params, 'P1ClIwi', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    
</div>
<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\projects\list-project.blade.php ENDPATH**/ ?>