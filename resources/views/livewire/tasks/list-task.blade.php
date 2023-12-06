<div class="container">
    <div class="main-body-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="main-body-header-title mb-0">All Tasks</h3>
                <div class="tabNavigationBar-tab">
                    <a class="tabNavigationBar-item" href="/task-list"><i class='bx bx-list-ul' ></i> List</a>
                    <a class="tabNavigationBar-item tabNavigationBar-item-active" href="#"><i class='bx bx-columns' ></i> Board</a>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <div class="d-flex gap-2 justify-content-end">
                        <a class="btn-border btn-border-primary" wire:navigate href="{{ route('task.add') }}"><i class='bx bx-plus' ></i> Add Task</a>
                        <a class="btn-border" href="#"><i class='bx bx-filter' ></i> Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kanban -->
    <div class="kanban_bord">
        <div class="kanban_bord_scrollbar">
            <div class="kanban_bord_body_columns">
                <div class="kanban_bord_column kanban_bord_column_assigned">
                    <div class="kanban_bord_column_title_wrap">
                        <div class="kanban_bord_column_title">Assigned</div>
                    </div>
                    <div class="kanban_column">
                        <div class="kanban_column_task kanban_column_task_overdue h-100">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>The logo should be add in the footer also.</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>26 Sep 2023</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <span>5+</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kanban_column_task kanban_column_task_overdue h-100">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>The logo should be add in the footer also.</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>26 Sep 2023</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <span>5+</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kanban_bord_column kanban_bord_column_accepted">
                    <div class="kanban_bord_column_title_wrap">
                        <div class="kanban_bord_column_title text-yellow-dark">Accepted</div>
                    </div>
                    <div class="kanban_column">
                        <div class="kanban_column_task kanban_column_task_warning h-100">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>The logo should be add in the footer also.</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>26 Sep 2023</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <span>5+</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kanban_column_task kanban_column_task_warning h-100">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>The logo should be add in the footer also.</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>26 Sep 2023</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <span>5+</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kanban_bord_column kanban_bord_column_in_review">
                    <div class="kanban_bord_column_title_wrap">
                        <div class="kanban_bord_column_title text-secondary">In Review</div>
                    </div>
                    <div class="kanban_column">
                        <div class="kanban_column_task kanban_column_task_overdue h-100">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>The logo should be add in the footer also.</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>26 Sep 2023</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <span>5+</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kanban_column_task kanban_column_task_overdue h-100">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>The logo should be add in the footer also.</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>26 Sep 2023</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <span>5+</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kanban_bord_column kanban_bord_column_completed">
                    <div class="kanban_bord_column_title_wrap">
                        <div class="kanban_bord_column_title text-success">Completed</div>
                    </div>
                    <div class="kanban_column">
                        <div class="kanban_column_task kanban_column_task_done h-100">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>The logo should be add in the footer also.</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>26 Sep 2023</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <span>5+</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kanban_column_task kanban_column_task_done h-100">
                            <div class="kanban_column_task-wrap">
                                <div class="card-options">
                                    <i class='bx bx-dots-horizontal-rounded' ></i>
                                </div>
                                <div class="kanban_column_task_name">
                                    <div class="kanban_column_task_complete_icon">
                                        <i class='bx bx-check' ></i>
                                    </div>
                                    <div class="kanban_column_task_name_text">
                                        <div>The logo should be add in the footer also.</div>
                                        <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
                                    </div>
                                </div>
                                <div class="kanban_column_task_bot">
                                    <div class="kanban_column_task_actions">
                                        <a href="#" class="kanban_column_task_date">
                                            <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                            <span>26 Sep 2023</span>
                                        </a>
                                    </div>
                                    <div>
                                        <!-- avatar group -->
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <img alt="avatar" src="../assets/images/avatar/user.jpg" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm">
                                                    <span>5+</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if($view_form)
        <livewire:tasks.add-task />
    @endif

    

</div>

@push('scripts')
    <script>
    </script>
@endpush
