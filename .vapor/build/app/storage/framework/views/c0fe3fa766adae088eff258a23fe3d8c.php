<div class="container">
    <!-- Dashboard Header -->
    <div class="main-body-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="main-body-header-title mb-0">All Tasks</h3>
                <div class="tabNavigationBar-tab">
                    <a class="tabNavigationBar-item tabNavigationBar-item-active" href="javascript:void(0);"><i class='bx bx-list-ul' ></i> List</a>
                    <a class="tabNavigationBar-item" wire:navigate href="<?php echo e(route('task.index')); ?>"><i class='bx bx-columns' ></i> Board</a>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="javascript:void(0);" class="btn-border btn-border-primary toggleForm"><i class='bx bx-plus'></i> Add Task</a>
                        <a class="btn-border btn-border-secondary" href="#"><i class='bx bx-filter' ></i> Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="taskList-dashbaord">
        <div class="taskList-wrap">
            <div class="taskList-dashbaord_tabs">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="task_list_tab_assigned-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_assigned" type="button" role="tab" aria-controls="task_list_tab_assigned" aria-selected="true">Assigned</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task_list_tab_progress-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_progress" type="button" role="tab" aria-controls="task_list_tab_progress" aria-selected="false">In Progress</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task_list_tab_review-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_review" type="button" role="tab" aria-controls="task_list_tab_review" aria-selected="false">In Review</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task_list_tab_complete-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_complete" type="button" role="tab" aria-controls="task_list_tab_complete" aria-selected="false">Completed</button>
                    </li>
                </ul>
                <div class="taskList-dashbaord_header">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="taskList-dashbaord_header_title taskList_col">Task Name</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Due Date</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Projects</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Assignee</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Notify</div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList-dashbaord_header_title taskList_col">Status</div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="task_list_tab_assigned" role="tabpanel" aria-labelledby="task_list_tab_assigned-tab" tabindex="0">
                        <div class="taskList">
                            <?php $__currentLoopData = $tasks['pending']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm(<?php echo e($task['id']); ?>)"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> <?php echo e($task->name); ?></div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col"><span class="btn-batch"><?php echo e(Carbon\Carbon::parse($task->due_date)->format('d M Y')); ?></span></div>
                                        </div>
                                        <div class="col text-center">
                                            <?php if($task->project): ?>
                                                <div class="taskList_col"><span class="btn-batch"><?php echo e($task->project->name); ?></span></div>
                                            <?php else: ?>
                                                <div class="taskList_col">-</div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="avatarGroup avatarGroup-overlap">
                                                    <?php $__currentLoopData = $task['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="#" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>">
                                                            <img alt="avatar" src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($user->image); ?>" class="rounded-circle" />
                                                        </span>
                                                    </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="avatarGroup avatarGroup-overlap">
                                                    <?php $__currentLoopData = $task['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="#" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>">
                                                            <img alt="avatar" src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($user->image); ?>" class="rounded-circle" />
                                                        </span>
                                                    </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="taskList_col">
                                                <div class="icon_group justify-content-center">
                                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="task_list_tab_progress" role="tabpanel" aria-labelledby="task_list_tab_progress-tab" tabindex="0">
                        <div>
                            <?php $__currentLoopData = $tasks['in_progress']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm(<?php echo e($task['id']); ?>)"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> <?php echo e($task->name); ?></div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col"><?php echo e(Carbon\Carbon::parse($task->due_date)->format('d M Y')); ?></div>
                                        </div>
                                        <div class="col text-center">
                                            <?php if($task->project): ?>
                                                <div class="taskList_col"><?php echo e($task->project->name); ?></div>
                                            <?php else: ?>
                                                <div class="taskList_col">-</div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="avatarGroup avatarGroup-overlap">
                                                    <?php $__currentLoopData = $task['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="#" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>">
                                                            <img alt="avatar" src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($user->image); ?>" class="rounded-circle" />
                                                        </span>
                                                    </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="taskList_col">
                                                    <div class="avatarGroup avatarGroup-overlap">
                                                        <?php $__currentLoopData = $task['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="#" class="avatarGroup-avatar">
                                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>">
                                                                <img alt="avatar" src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($user->image); ?>" class="rounded-circle" />
                                                            </span>
                                                        </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="taskList_col">
                                                <div class="icon_group justify-content-center">
                                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="task_list_tab_review" role="tabpanel" aria-labelledby="task_list_tab_review-tab" tabindex="0">
                        <div>
                            <?php $__currentLoopData = $tasks['in_review']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm(<?php echo e($task['id']); ?>)"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> <?php echo e($task->name); ?></div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col"><?php echo e(Carbon\Carbon::parse($task->due_date)->format('d M Y')); ?></div>
                                        </div>
                                        <div class="col text-center">
                                            <?php if($task->project): ?>
                                                <div class="taskList_col"><?php echo e($task->project->name); ?></div>
                                            <?php else: ?>
                                                <div class="taskList_col">-</div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="avatarGroup avatarGroup-overlap">
                                                    <?php $__currentLoopData = $task['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="#" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>">
                                                            <img alt="avatar" src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($user->image); ?>" class="rounded-circle" />
                                                        </span>
                                                    </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="taskList_col">
                                                    <div class="avatarGroup avatarGroup-overlap">
                                                        <?php $__currentLoopData = $task['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="#" class="avatarGroup-avatar">
                                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>">
                                                                <img alt="avatar" src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($user->image); ?>" class="rounded-circle" />
                                                            </span>
                                                        </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="taskList_col">
                                                <div class="icon_group justify-content-center">
                                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="task_list_tab_complete" role="tabpanel" aria-labelledby="task_list_tab_complete-tab" tabindex="0">
                        <div>
                            <?php $__currentLoopData = $tasks['completed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm(<?php echo e($task['id']); ?>)"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> <?php echo e($task->name); ?></div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col"><?php echo e(Carbon\Carbon::parse($task->due_date)->format('d M Y')); ?></div>
                                        </div>
                                        <div class="col text-center">
                                            <?php if($task->project): ?>
                                                <div class="taskList_col"><?php echo e($task->project->name); ?></div>
                                            <?php else: ?>
                                                <div class="taskList_col">-</div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="avatarGroup avatarGroup-overlap">
                                                    <?php $__currentLoopData = $task['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="#" class="avatarGroup-avatar">
                                                        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>">
                                                            <img alt="avatar" src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($user->image); ?>" class="rounded-circle" />
                                                        </span>
                                                    </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col">
                                                <div class="taskList_col">
                                                    <div class="avatarGroup avatarGroup-overlap">
                                                        <?php $__currentLoopData = $task['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="#" class="avatarGroup-avatar">
                                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>">
                                                                <img alt="avatar" src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($user->image); ?>" class="rounded-circle" />
                                                            </span>
                                                        </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="taskList_col">
                                                <div class="icon_group justify-content-center">
                                                    <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                    <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <?php if($view_form): ?>
    <div class="AddCanvas">
        <!-- Add Task Canvas Header -->
        <div class="AddTask_head">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="AddTask_title-wrap">
                        <label class="AddTask_title-lable"><span class="AddTask_title-icon"><i class='bx bx-notepad'></i></span> Task Title</label>
                        <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Type your task here...">
                    </div>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-5">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="javascript:;" wire:click="store" class="btn-border btn-border-sm btn-border-success"><i class='bx bx-check'></i> Save</a>
                        <a href="javascript:;" wire:click="toggleForm" class="btn-border btn-border-sm btn-border-primary"><i class='bx bx-x' ></i> Close</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Task Canvas Body -->
        <div class="AddTask_body">
            <div class="AddTask_body_overview">
                <form  method="POST">
                    <div class="AddTask_rulesOverview">
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Assigned to</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select name="" id="" class="form-control users" multiple>
                                    <option value="" disabled>Select User</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option data-image="<?php echo e($user->image); ?>" value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Notify to</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select name="" id="" class="form-control users" multiple>
                                    <option value="" disabled>Select User</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option data-image="<?php echo e($user->image); ?>" value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Project</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select  id="project_id" class="form-control">
                                    <option value="">Select Project</option>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Due Date</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="rulesAction_group">
                                            
                                            <a href="#" class="rulesAction-item-date rulesAction_group-item">
                                                <div class="icon_rounded"><i class='bx bx-calendar' ></i></div>
                                                <span class="btn_link add_date_btn">Add Date</span>
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Description</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <textarea name="" id="editor" cols="30" rows="10"></textarea>
                            </div>
                        </div>
    
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if($edit_task): ?>
    <div class="AddCanvas">
        <!-- edit Task Canvas Header -->
        <div class="AddTask_head">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="AddTask_title-wrap">
                        <label class="AddTask_title-lable"><span class="AddTask_title-icon"><i class='bx bx-notepad'></i></span> Task Title</label>
                        <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Type your task here...">
                    </div>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-5">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="javascript:;" wire:click="updateTask" class="btn-border btn-border-sm btn-border-success"><i class='bx bx-check'></i> Save</a>
                        <a href="<?php echo e(route('task.list-view')); ?>" wire:navigate class="btn-border btn-border-sm btn-border-primary"><i class='bx bx-x' ></i> Close</a>
                        <a href="<?php echo e(route('task.index')); ?>" wire:navigate class="btn-border btn-border-sm btn-border-danger"><i class='bx bx-trash' ></i> Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit Task Canvas Body -->
        <div class="AddTask_body">
            <div class="AddTask_body_overview">
                <form  method="POST">
                    <div class="AddTask_rulesOverview">
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Assigned to</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select name="" id="" class="form-control users" multiple>
                                    <option value="" disabled>Select User</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(in_array($user->id, $user_ids)): ?>
                                                <option data-image="<?php echo e($user->image); ?>" value="<?php echo e($user->id); ?>" selected><?php echo e($user->name); ?></option>
                                            <?php else: ?>
                                                <option data-image="<?php echo e($user->image); ?>" value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Notify to</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select name="" id="" class="form-control users" multiple>
                                    <option value="" disabled>Select User</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(in_array($user->id, $user_ids)): ?>
                                            <option data-image="<?php echo e($user->image); ?>" value="<?php echo e($user->id); ?>" selected><?php echo e($user->name); ?></option>
                                        <?php else: ?>
                                            <option data-image="<?php echo e($user->image); ?>" value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Project</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select  id="project_id" class="form-control">
                                    <option value="">Select Project</option>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if($project_id == $project->id): ?> selected <?php endif; ?> value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Due Date</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="rulesAction_group">
                                            
                                            <a href="#" class="rulesAction-item-date rulesAction_group-item">
                                                <div class="icon_rounded"><i class='bx bx-calendar' ></i></div>
                                                <span class="btn_link add_date_btn"><?php echo e($dueDate); ?></span>
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Description</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <textarea name="" id="editor" cols="30" rows="10"><?php echo e($description); ?></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <h5 class="cmnt_act_title"><i class='bx bx-line-chart text-primary'></i> Activity</h5>
                <div class="cmnt_act">
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cmnt_act_row">
                        <div class="cmnt_act_user">
                            <div class="cmnt_act_user_img">
                                <img class="rounded-circle" src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($comment->user->image); ?>">
                            </div>
                            <div class="cmnt_act_user_name-wrap">
                                <div class="cmnt_act_user_name"><?php echo e($comment->user->name); ?></div>
                                <div class="cmnt_act_date"><?php echo e($comment->created_at->diffForHumans()); ?></div>
                                <div class="cmnt_act_user_text"><?php echo $comment->comment; ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <div class="AddTask_body_overview">
                    <div class="AddTask_rulesOverview">
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Comment</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <textarea name="" id="comment_box" cols="30" rows="5"></textarea>
                            </div>
                            <div class="AddTask_rulesOverview_item_name mt-3"></div>
                            <div class="AddTask_rulesOverview_item_rulesAction mt-3">
                                <button wire:click="saveComment" class="btn btn-primary btn-sm"><i class="bx bx-comment"></i></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>


<?php $__env->startPush('scripts'); ?>
    <script>
        if(typeof users_for_mention === 'undefined'){
            var users_for_mention = [];
            var users = <?php echo json_encode($users, 15, 512) ?>;
            users.forEach(user => {
                users_for_mention.push(user.name);
            });
        }else{
            var users_for_mention = users_for_mention;
            var users = <?php echo json_encode($users, 15, 512) ?>;
        }

        $(document).ready(function(){
            $(".accordion-header").click(function(){
                // toggle div below one which is clicked
                $(this).next(".accordion-collapse").toggle(function(){
                    // add animation when toggling
                    if($(this).is(":visible")){
                        $(this).animate({
                            opacity: "1"
                        }, "slow");
                    } else {
                        $(this).animate({
                            opacity: "0"
                        }, "slow");
                    }
                });
            });
        });

        $(".toggleForm").click(function(){
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').toggleForm();
        });

        // File manager button (image icon)

        if(typeof FMButton === 'undefined'){
            var FMButton = function(context) {
                const ui = $.summernote.ui;
                const button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'File Manager',
                    click: function() {
                    window.open('/file-manager/summernote', 'fm', 'width=1400,height=800');
                    }
                });
                return button.render();
            };
        }else{
            var FMButton = FMButton;
        }

        // set file link
        function fmSetLink(url) {
            $('#editor').summernote('insertImage', url);
            $('#comment_box').summernote('insertImage', url);
        }

        function initPlugins(){
                $("#editor").summernote({
                    height: 200,
                    hint: {
                        mentions: users_for_mention,
                        match: /\B@(\w*)$/,
                        search: function (keyword, callback) {
                            callback($.grep(this.mentions, function (item) {
                                return item.indexOf(keyword) == 0;
                            }));
                        },
                        template : function (item) {
                            return '<img src="<?php echo e(env('APP_URL')); ?>/storage/' + users[users_for_mention.indexOf(item)].image + '" class="img-fluid rounded-circle" style="width: 20px; height: 20px; margin-right: 5px;"/>' + item;
                        },
                        content: function (item) {
                            item = item.replace(/\s/g, '_');
                            let span = document.createElement('a');
                            $(span).addClass('mention_user');
                            $(span).text(' '+'@' + item + ' ');
                            return span;
                        }    
                    },
                    toolbar: [
                        ['font', ['bold', 'underline']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link']],
                        ['fm-button', ['fm']],
                    ],
                    callbacks: {
                        onChange: function(contents, $editable) {
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('description', contents);
                        }
                    },
                    buttons: {
                        fm: FMButton
                    }
                });

                $("#comment_box").summernote({
                    height: 100,
                    hint: {
                        mentions: users_for_mention,
                        match: /\B@(\w*)$/,
                        search: function (keyword, callback) {
                            callback($.grep(this.mentions, function (item) {
                                return item.indexOf(keyword) == 0;
                            }));
                        },
                        template : function (item) {
                            return '<img src="<?php echo e(env('APP_URL')); ?>/storage/' + users[users_for_mention.indexOf(item)].image + '" class="img-fluid rounded-circle" style="width: 20px; height: 20px; margin-right: 5px;"/>' + item;
                        },
                        content: function (item) {
                            item = item.replace(/\s/g, '_');
                            let span = document.createElement('a');
                            $(span).addClass('mention_user');
                            $(span).text(' '+'@' + item + ' ');
                            return span;
                        }    
                    },
                    toolbar: [
                        ['font', ['bold', 'underline']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link']],
                        ['fm-button', ['fm']],
                    ],
                    callbacks: {
                        onChange: function(contents, $editable) {
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('comment', contents);
                        }
                    },
                    buttons: {
                        fm: FMButton
                    }
                });
    
            document.addEventListener('comment-added', function () {
                $("#comment_box").summernote("code", "");
            });

            $('.users').select2({
                placeholder: 'Select User',
                templateResult: format,
                templateSelection: format,
                escapeMarkup: function(m) {
                    return m;
                }
            });
    
            $('.users').on('change', function(e){
                var users = $('.users');
                var selected_users = users.val();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('user_ids', selected_users);
            });
    
            $('#project_id').select2({
                placeholder: 'Select Project',
            });
    
            $('#project_id').on('change', function(e){
                var project_id = $('#project_id').val();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('project_id', project_id);
            });
    
            function format(state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "<?php echo e(env('APP_URL')); ?>/storage";
                var $state = $(
                    '<span><img class="select2-selection__choice__display_userImg" src="' + baseUrl + '/' + state.element.attributes[0].value + '" /> ' + state.text + '</span>'
                );
                return $state;
            };

            $('.add_date_btn').flatpickr({
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".add_date_btn").html(dateStr);
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('dueDate', dateStr);
                },
            });
        }

    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\tasks\task-list-view.blade.php ENDPATH**/ ?>