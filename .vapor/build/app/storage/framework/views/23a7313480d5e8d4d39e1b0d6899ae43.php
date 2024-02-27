<div class="container">
    <!-- Dashboard Header -->
    <div class="main-body-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="main-body-header-title mb-0">All Tasks</h3>
                <div class="tabNavigationBar-tab">
                    <a class="tabNavigationBar-item" wire:navigate href="<?php echo e(route('task.list-view')); ?>"><i class='bx bx-list-ul' ></i> List</a>
                    <a class="tabNavigationBar-item tabNavigationBar-item-active" href="#"><i class='bx bx-columns' ></i> Board</a>
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
    <!-- Kanban -->
    <div class="kanban_bord">
        <div class="kanban_bord_scrollbar">
            <div class="kanban_bord_body_columns" wire:sortable-group="updateTaskOrder">
                <?php
                    $groups = ['pending','in_progress','in_review','completed'];
                ?>
                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $board_class = '';
                        if($group=='pending'){
                            $board_class = 'kanban_bord_column_assigned';
                        }
                        if($group=='in_progress'){
                            $board_class = 'kanban_bord_column_accepted';
                        }
                        if($group=='in_review'){
                            $board_class = 'kanban_bord_column_in_review';
                        }
                        if($group=='completed'){
                            $board_class = 'kanban_bord_column_completed';
                        }
                    ?>
                    <div class="kanban_bord_column <?php echo e($board_class); ?>" wire:key="group-<?php echo e($group); ?>"  wire:sortable.item="<?php echo e($group); ?>">
                        <div class="kanban_bord_column_title_wrap">
                            <div class="kanban_bord_column_title" wire:sortable.handle>
                                <?php if($group == 'pending'): ?>
                                    Assigned
                                <?php elseif($group == 'in_progress'): ?>
                                    Accepted
                                <?php elseif($group == 'in_review'): ?>
                                    In Review
                                <?php elseif($group == 'completed'): ?>
                                    Completed
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="kanban_column" wire:sortable-group.item-group="<?php echo e($group); ?>" wire:sortable-group.options="{ 
                            animation: 400 ,
                            easing: 'cubic-bezier(1, 0, 0, 1)',
                            onStart: function (evt) {
                                console.log(evt);
                                // change the color of the dragging item
                                evt.item.style.background = '#fff';
                            },
                        }">
                            <?php if(!count($tasks[$group])): ?>
                            <div class="kanban_column_empty"><i class='bx bx-add-to-queue'></i></div>
                            <?php endif; ?>
                            <?php $__currentLoopData = $tasks[$group]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $date_class = '';
                                    if($task['due_date'] < date('Y-m-d')){
                                        $date_class = 'kanban_column_task_overdue';
                                    }
                                    if($task['due_date'] == date('Y-m-d')){
                                        $date_class = 'kanban_column_task_warning';
                                    }
                                    
                                ?>
                                <div class="kanban_column_task <?php echo e($date_class); ?> h-100" wire:key="task-<?php echo e($task['id']); ?>" wire:sortable-group.item="<?php echo e($task['id']); ?>" >
                                    <div class="kanban_column_task-wrap" wire:sortable-group.handle>
                                        <div class="card-options d-none">
                                            <i class='bx bx-dots-horizontal-rounded' ></i>
                                        </div>
                                        <div class="kanban_column_task_name">
                                            <div class="kanban_column_task_complete_icon d-none">
                                                <i class='bx bx-check' ></i>
                                            </div>
                                            <div class="kanban_column_task_name_text">
                                                <div wire:click="enableEditForm(<?php echo e($task['id']); ?>)"><?php echo e($task['name']); ?></div>
                                                <div class="kanban_column_task_project_name">
                                                    <span>
                                                        <?php if($task['project']): ?>
                                                        <i class='bx bx-file-blank' ></i>  <?php echo e($task['project']['name']); ?> 
                                                        <?php endif; ?>
                                                    </span>
                                                    <span>
                                                        <?php if(count($task['comments']) > 0): ?>
                                                        <i class='bx bx-chat' ></i>  <?php echo e(count($task['comments'])); ?>

                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kanban_column_task_bot">
                                            <div class="kanban_column_task_actions">
                                                <a href="#" class="kanban_column_task_date task">
                                                    <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                                    <span class=""><?php echo e($task['due_date']); ?></span>
                                                </a>
                                            </div>
                                            <div>
                                                <!-- avatar group -->
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
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    
    
    <?php if($view_form): ?>
    <div class="AddCanvas ">
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
                        <a href="<?php echo e(route('task.index')); ?>" wire:navigate  class="btn-border btn-border-sm btn-border-primary close-add-task-form"><i class='bx bx-x' ></i> Close</a>
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
                                    <option value="" disabled selected>Select Project</option>
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
                        <a href="#" wire:click="updateTask" class="btn-border btn-border-sm btn-border-success"><i class='bx bx-check'></i> Update</a>
                        <a href="<?php echo e(route('task.index')); ?>" wire:navigate class="btn-border btn-border-sm btn-border-primary"><i class='bx bx-x' ></i> Close</a>
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
                                            
                                            <span class="req_calender_opt" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"><i class='bx bx-repeat'></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
    
                        <!-- Description -->
                        <div class="AddTask_rulesOverview_item mb-5" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Description</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <textarea name="" id="editor" cols="30" rows="10"><?php echo e($description); ?></textarea>
                            </div>
                        </div>

                        <!-- Requiring Task Date  -->
                        <div class="req_calender d-none">
                            <div class="req_calender-wrap">
                                <div class="req_calender-header">
                                    <div class="req_calender-header-item">
                                        <a href="#" class="req_calender-header-item-date req_calender-header-item-date-primary">
                                            <span><i class='bx bx-calendar-alt'></i></span> Start Date
                                        </a>
                                        <Tooltip title="Due Date" arrow>
                                            <a href="" class="req_calender-header-item-date req_calender-header-item-date-secondary">
                                                <span><i class='bx bx-calendar-alt'></i></span> Due Date
                                            </a>
                                        </Tooltip>
                                    </div>
                                </div>
                                <div class="req_calender-body">
                                    <div class="req_calender-repeats">
                                        <div class="req_calender-label">Repeats</div>
                                        <div>
                                            <select class="planHoverStyle" aria-label="Weekly">
                                                <option value="1">Weekly</option>
                                                <option value="2">Monthly</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="req_calender-repeats-weekly">
                                        <h4 class="req_calender-repeats-lable">On These Days</h4>
                                        <ul class="req_calender-repeats-weekly-day_select">
                                            <li><span>S</span></li>
                                            <li class="active"><span>M</span></li>
                                            <li><span>T</span></li>
                                            <li><span>W</span></li>
                                            <li><span>T</span></li>
                                            <li><span>F</span></li>
                                            <li><span>S</span></li>
                                        </ul>
                                    </div>

                                    <div class="req_calender-repeats-monthly">
                                        <div class="req_calender-repeats-monthly">
                                            <div class="req_calender-repeats-monthly-item">
                                                <div>
                                                    <a class="req_calender-repeats-monthly-opt active">
                                                        <span><i class='bx bx-checkbox-checked' ></i></span> On The
                                                    </a>
                                                </div>
                                                <div>
                                                    <div class="req_calender-repeats-monthly-onThe-r">
                                                        <select class="planHoverStyle" aria-label="Monthly">
                                                            <option value="1">1st</option>
                                                            <option value="2">2nd</option>
                                                            <option value="3">3rd</option>
                                                            <option value="4">4th</option>
                                                            <option value="5">Last</option>
                                                        </select>
                                                        <select class="planHoverStyle" aria-label="Monthly">
                                                            <option value="1">Sunday</option>
                                                            <option value="2">Monday</option>
                                                            <option value="3">Tuesday</option>
                                                            <option value="4">Wednesday</option>
                                                            <option value="5">Thursday</option>
                                                            <option value="5">Firday</option>
                                                            <option value="5">Suterday</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="req_calender-repeats-monthly-item mt-4">
                                                <div>
                                                    <a class="req_calender-repeats-monthly-opt">
                                                        <span><i class='bx bx-checkbox' ></i></span> On Day
                                                    </a>
                                                </div>
                                                <div>
                                                    <select class="planHoverStyle" aria-label="Monthly">
                                                        <option value="1">1st</option>
                                                        <option value="2">2nd</option>
                                                        <option value="3">3rd</option>
                                                        <option value="4">4th</option>
                                                        <option value="5">Last</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="req_calender-repeats-info">Every Monday of the week</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Activity -->
                

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

                <div class="custComment">
                    <div class="custComment-wrap">
                        <div class="custComment-editor" wire:ignore>
                            <textarea name="" id="comment_box" cols="30" rows="5"></textarea>
                        </div>
                        <button wire:click="saveComment" class="custComment-btn"><i class='bx bx-send'></i> Comment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        // $(document).ready(function(){
        //     $(".add-task-form").hide();
        // });
        // check if users_for_mention is already declared
        
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
                            return '<span class="mention_user" data-id=" ' + users[users_for_mention.indexOf(item)].id + ' "><img src="<?php echo e(env('APP_URL')); ?>/storage/' + users[users_for_mention.indexOf(item)].image + '" class="img-fluid rounded-circle" style="width: 20px; height: 20px; margin-right: 5px;"/>' + item + '</span>';
                        },
                        content: function (item) {
                            item = item.replace(/\s/g, '_');
                            let span = document.createElement('a');
                            $(span).addClass('mention_user');
                            $(span).text(' '+'@' + item + ' ');
                            return span;
                        },    
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
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\tasks\list-task.blade.php ENDPATH**/ ?>