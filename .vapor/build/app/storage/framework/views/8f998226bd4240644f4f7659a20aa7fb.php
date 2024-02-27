<div class="AddCanvas">
    <!-- Add Task Canvas Header -->
    <div class="AddTask_head">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="AddTask_title-wrap">
                    <div class="AddTask_title-icon"><i class='bx bx-notepad'></i></div>
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
            <div class="col-md-4">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="#" wire:click="store" class="btn-border btn-border-primary"><i class='bx bx-check'></i> Save</a>
                    <a href="<?php echo e(route('task.index')); ?>" wire:navigate class="btn-border"><i class='bx bx-x' ></i> Close</a>
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

<?php $__env->startPush('scripts'); ?>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        '|',
                        'italic',
                        '|',
                        'link',
                        '|',
                        'bulletedList',
                        '|',
                        'numberedList',
                        '|',
                    ]
                },
            } )
            .then( editor => {
                    editor.model.document.on( 'change:data', () => {
                        console.log( 'The Document has changed!' );
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('description', editor.getData());
                    } )
            } )
            .catch( error => {
                    console.error( error );
            } );

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
                '<span><img height="25px" width="25px" src="' + baseUrl + '/' + state.element.attributes[0].value + '" class="img-thumbnail" /> ' + state.text + '</span>'
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
    </script>
<?php $__env->stopPush(); ?>



<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\tasks\add-task.blade.php ENDPATH**/ ?>