<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="<?php echo e(route('dashboard')); ?>"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="<?php echo e(route('client.index')); ?>">All Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($client->name); ?></li>
        </ol>
    </nav>
    <div class="dashboard-head mb-4">
        <div class="row align-items-center">
            <div class="col">
                <div class="dashboard-head-title-wrap">
                    <div class="client_head_logo"><img src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($client->image); ?>" alt=""></div>
                    <div>
                        <h3 class="main-body-header-title mb-0"><?php echo e($client->name); ?> </h3>
                        <div class="client_head-date">
                            <?php echo e(\Carbon\Carbon::parse($client->onboard_date)->format('d M-Y')); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <!-- Edit -->
                    <div class="cus_dropdown">
                        <!-- For Active Class = btn-border-success | For Archived Class = btn-border-archived -->
                        <?php if(!$client->trashed()): ?>
                            <div class="cus_dropdown-icon btn-border btn-border-success">Active <i class='bx bx-chevron-down' ></i></div>
                        <?php else: ?>
                            <div class="cus_dropdown-icon btn-border btn-border-archived">Archived <i class='bx bx-chevron-down' ></i></div>
                        <?php endif; ?>

                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a wire:click="changeClientStatus('active')" <?php if(!$client->trashed()): ?> class="active" <?php endif; ?>><span><i class='bx bx-user-check' ></i></span> Active</a></li>
                                    <li><a wire:click="changeClientStatus('archived')" <?php if($client->trashed()): ?> class="active" <?php endif; ?> ><span><i class='bx bx-user-minus' ></i></span> Archived</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button <?php if($client->trashed()): ?> disabled <?php endif; ?> wire:click="emitEditClient(<?php echo e($client->id); ?>)" class="btn-sm btn-border btn-border-secondary "><i class='bx bx-pencil'></i> Edit</button>
                    <a href="#" class="btn-sm btn-border btn-border-danger" wire:click="forceDeleteClient(<?php echo e($client->id); ?>)"><i class='bx bx-trash'></i> Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Body -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="column-box h-100">
                <div class="column-head d-flex flex-wrap gap-20 align-items-center mb-4">
                    <div>
                        <h5 class="mb-0">All Projects</h5>
                        <div class="text-light"><?php echo e(count($client->projects)); ?> Projects</div>
                    </div>
                    <div class="ms-auto">
                        <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#projectModal"><i class="bx bx-plus"></i> Add Project</a>
                    </div>
                </div>
                <div class="project-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="true">Active</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link project-tabs-completed" id="project-done-tab" data-bs-toggle="tab" data-bs-target="#project-done-tab-pane" type="button" role="tab" aria-controls="project-done-tab-pane" aria-selected="false">Completed</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link project-tabs-overdue" id="project-overdue-tab" data-bs-toggle="tab" data-bs-target="#project-overdue-tab-pane" type="button" role="tab" aria-controls="project-overdue-tab-pane" aria-selected="false">Overdue</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link project-tabs-archived" id="project-archived-tab" data-bs-toggle="tab" data-bs-target="#project-archived-tab-pane" type="button" role="tab" aria-controls="project-archived-tab-pane" aria-selected="false">Archived</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="project-active-tab-pane" role="tabpanel" aria-labelledby="project-active-tab" tabindex="0">
                        <div class="project-list">
                            <?php $__currentLoopData = $active_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="project project-align_left project-overdue">
                                    <div class="project-icon">
                                        <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                    </div>
                                    <div class="project-content">
                                        <a href="#" class="project-title"><?php echo e($project->name); ?></a>
                                        <?php if($project->due_date): ?>
                                            <div class="project-selected-date">Due on <span><?php echo e($project->due_date); ?></span></div>
                                        <?php else: ?>
                                            <div class="project-selected-date">Due on <span>No Due Date</span></div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Edit -->
                                    <div class="cus_dropdown cus_dropdown-edit">
                                        <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                            <div class="cus_dropdown-body-wrap">
                                                <ul class="cus_dropdown-list">
                                                    <li><a href="#" wire:click="editProject(<?php echo e($project->id); ?>)"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                                    <li><a href="#"><span wire:click="deleteProject(<?php echo e($project->id); ?>)" class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project-done-tab-pane" role="tabpanel" aria-labelledby="project-done-tab" tabindex="0">
                        <div class="project-list project-list-completed">
                            <?php $__currentLoopData = $completed_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title"><?php echo e($project->name); ?></a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project-overdue-tab-pane" role="tabpanel" aria-labelledby="project-overdue-tab" tabindex="0">
                        <div class="project-list project-list-overdue">
                            <?php $__currentLoopData = $overdue_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="project project-align_left">
                                    <div class="project-icon">
                                        <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                    </div>
                                    <div class="project-content">
                                        <a href="#" class="project-title"><?php echo e($project->name); ?></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project-archived-tab-pane" role="tabpanel" aria-labelledby="project-archived-tab" tabindex="0">
                        <div class="project-list project-list-archive">
                            <?php $__currentLoopData = $archived_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title"><?php echo e($project->name); ?></a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="column-box h-100">
                <div class="column-head d-flex flex-wrap align-items-center">
                    <div>
                        <h5 class="mb-0">Teams</h5>
                        <div class="text-light"><?php echo e($client->teams->count()); ?> Teams Assigned</div>
                    </div>
                    <div class="ms-auto">
                        <a class="btn-icon btn-icon-primary" href="#" data-bs-toggle="modal" data-bs-target="#teamModal"><i class="bx bx-plus"></i></a>
                    </div>
                </div>
                <div class="team-scroll scrollbar">
                    <!-- Teams -->
                    <div class="team-list">
                        <?php $__currentLoopData = $client->teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="team team-style_2 editTeam">
                                <!-- Edit -->
                                <div class="cus_dropdown cus_dropdown-edit">
                                    <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                                    <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                        <div class="cus_dropdown-body-wrap">
                                            <ul class="cus_dropdown-list">
                                                <li><a href="#" wire:click="editTeam(<?php echo e($team->id); ?>)"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                                <li><a href="#" wire:click="deleteTeam(<?php echo e($team->id); ?>)"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-style_2-head_wrap">
                                    <div class="team-avtar">
                                        <span>
                                            <img src="<?php echo e(env('APP_URL')); ?>/storage/<?php echo e($team->image); ?>" alt="">
                                        </span>
                                    </div>
                                    <h4 class="team-style_2-title"><?php echo e($team->name); ?> 
                                        <span class="team-style_2-memCount">
                                            <?php
                                                $team_user_count = [];
                                                $team_users = $team->users->pluck('id')->toArray();
                                                $client_users = $client->users->pluck('id')->toArray();
                                                foreach($team_users as $team_user){
                                                    if(in_array($team_user, $client_users)){
                                                        $team_user_count[] = $team_user;
                                                    }
                                                }
                                                echo count($team_user_count);
                                                $team_user_count = [];
                                            ?>
                                            Members
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div>
                    <a class="btn btn-sm btn-border-primary w-100" href="#" data-bs-toggle="modal" data-bs-target="#teamModal"><i class="bx bx-plus"></i> Add Team</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.file-manager', ['client' => $client]);

$__html = app('livewire')->mount($__name, $__params, '7OoZS42', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
    </div>

    <!-- Project Modal -->
    <div wire:ignore class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-layer' ></i></span> <span class="project-modal-title">Add Project</span></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addProject" method="POST" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Project Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="project_name" type="text" class="form-style" placeholder="Project Name Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Date</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="btn-list btn-list-full-2 justify-content-between gap-10">
                                        <a  class="btn btn-50 btn-sm btn-border-secondary project_start_date"><i class='bx bx-calendar-alt' ></i> Start Date</a>
                                        <a  class="btn btn-50 btn-sm btn-border-danger project_due_date"><i class='bx bx-calendar-alt' ></i> Due Date</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Upload Logo</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="form-file_upload form-file_upload-logo">
                                        <input type="file" id="formFile">
                                        <div class="form-file_upload-box">
                                            <div class="form-file_upload-box-icon"><i class='bx bx-image'></i></div>
                                            <div class="form-file_upload-box-text">Upload Image</div>
                                        </div>
                                        <div class="form-file_upload-valText">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Project Desc</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <textarea wire:model="project_description" type="text" class="form-style" placeholder="Add Project Description Here..." rows="2" cols="30"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary project-modal-btn">Add Project</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Modal -->
    <div wire:ignore.self class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-group' ></i></span> Add Team</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit="assignTeam">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Team</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <select class="form-style team_id" wire:model.live="team_id">
                                        <option value="">Select Team</option>
                                        <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($team->id); ?>"><?php echo e($team->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row team_users_col">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Users</label>
                                </div>
                                <div class="col-md-8 mb-4" >
                                    <select class="form-style team_users" class="form-control" multiple wire:model="team_users">
                                        <option value="">Select Users</option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-image="<?php echo e($user->image); ?>" value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary">Add Team</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Team Modal -->
    <div wire:ignore.self class="modal fade" id="updateTeamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-group' ></i></span> Update Team</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit="updateTeam">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Team</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <select class="form-style team_id" wire:model.live="team_id">
                                        <option value="">Select Team</option>
                                        <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($team->id); ?>"><?php echo e($team->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row team_users_col">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Users</label>
                                </div>
                                <div class="col-md-8 mb-4" >
                                    <select class="form-style team_users" class="form-control" multiple wire:model="team_users">
                                        <option value="">Select Users</option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option 
                                                <?php if(in_array($user->id, $team_users)): ?>
                                                    selected
                                                <?php endif; ?>
                                            data-image="<?php echo e($user->image); ?>" value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary">Update Team</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.add-client', ['@saved' => '$refresh']);

$__html = app('livewire')->mount($__name, $__params, 'RViymOz', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

    
    
</div>
<?php $__env->startPush('scripts'); ?>
<script>

    $('.project_start_date').flatpickr({
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            $(".project_start_date").html(dateStr);
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('project_start_date', dateStr);
        },
    });

    $('.project_due_date').flatpickr({
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            $(".project_due_date").html(dateStr);
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('project_due_date', dateStr);
        },
    });

    $(document).on('change', '.team_users', function(){
        var selected = $(this).val();
        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('team_users', selected);
        setTimeout(() => {
            $(".team_users").select2({
                placeholder: "Select Users",
                allowClear: true,
                templateResult: format,
                templateSelection: format,
            });
        }, 1000);
    });

    document.addEventListener('teamSelected', event => {
        setTimeout(() => {
            $(".team_users").select2({
                placeholder: "Select Users",
                allowClear: true,
                templateResult: format,
                templateSelection: format,
            });
        }, 100);
    })

    document.addEventListener('teamSelectedForEdit', event => {

        let selected_users_ids = event.detail;

        $("#updateTeamModal").modal('show');

        setTimeout(() => {

            console.log(selected_users_ids);
            $(".team_users").val(selected_users_ids).trigger('change');
        }, 1000);
    })

    document.addEventListener('teamAssigned', event => {
        $("#teamModal").modal('hide');
    });


    document.addEventListener('teamUpdated', event => {
        $("#updateTeamModal").modal('hide');
    });

    document.addEventListener('editProject', event => {
        $("#projectModal").modal('show');
        $(".project-modal-title").html('Edit Project');
        $(".project-modal-btn").html('Update Project');
        if(event.detail[0].due_date){
            $('.project_start_date').flatpickr().setDate(event.detail[0].start_date);
            $(".project_start_date").html(event.detail[0].start_date);
        }
        if(event.detail[0].due_date){
            $('.project_due_date').flatpickr().setDate(event.detail[0].due_date);
            $(".project_due_date").html(event.detail[0].due_date);
        }

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
    
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\clients\client.blade.php ENDPATH**/ ?>