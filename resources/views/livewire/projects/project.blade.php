<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buyers Guide</li>
        </ol>
    </nav>
    <div class="dashboard-head mb-4">
        <div class="row align-items-center">
            <div class="col">
                <div class="dashboard-head-title-wrap">
                    <div class="client_head_logo"><img src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" alt=""></div>
                    <div>
                        <div class="client_head-date">Acma</div>
                        <h3 class="main-body-header-title mb-0">Buyers Guide</h3>
                    </div>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <!-- Edit -->
                    <div class="cus_dropdown">
                        <!-- For Active Class = btn-border-success | For Archived Class = btn-border-archived -->
                        <div class="cus_dropdown-icon btn-border btn-border-success">Active <i class='bx bx-chevron-down' ></i></div>
                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a href="#" class="active"><span><i class='bx bx-user-check' ></i></span> Active</a></li>
                                    <li><a href="#"><span><i class='bx bx-user-minus' ></i></span> Archived</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn-sm btn-border btn-border-secondary"><i class='bx bx-pencil'></i> Edit</a>
                    <a href="#" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Body -->
    <div class="row">
        <div class="col-md-4">
            <div class="column-box">
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-layer text-success' ></i></span> Created By</div>
                    <div class="col">Rakesh Roshan</div>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar-alt text-primary'></i></span> Start Date</div>
                    <div class="col">26 April 2024 <a href="#" class="ms-2"><i class='bx bx-pencil text-primary'></i></a></div>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar text-danger'></i></span> Due Date</div>
                    <div class="col">26 April 2024 <a href="#" class="ms-2"><i class='bx bx-pencil text-primary'></i></a></div>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-time text-secondary'></i></span> Duration</div>
                    <div class="col">3 Months</div>
                </div>
                <hr>
                <div class="row align-items-center mb-3">
                    <div class="col"><span><i class='bx bx-user text-primary' ></i></span> Assigness</div>
                    <div class="col">
                        <!-- Avatar Group -->
                        <div class="avatarGroup avatarGroup-lg avatarGroup-overlap">
                            <a href="#" class="avatarGroup-avatar">
                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajay Kumar">
                                    <img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle">
                                </span>
                            </a>
                            <a href="#" class="avatarGroup-avatar">
                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Roshan Jajoria">
                                    <img alt="avatar" src="http://localhost:8000/storage/images/users/Roshan Jajoria.png" class="rounded-circle">
                                </span>
                            </a>
                            <a href="#" class="avatarGroup-avatar">
                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Singh">
                                    <img alt="avatar" src="http://localhost:8000/storage/images/users/Chetan Singh.png" class="rounded-circle">
                                </span>
                            </a>
                            <a href="#" class="avatarGroup-avatar">
                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Singh">
                                    <img alt="avatar" src="http://localhost:8000/storage/images/users/Chetan Singh.png" class="rounded-circle">
                                </span>
                            </a>
                            <a href="#" class="avatarGroup-avatar">
                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Singh">
                                    <img alt="avatar" src="http://localhost:8000/storage/images/users/Chetan Singh.png" class="rounded-circle">
                                </span>
                            </a>
                            <a href="#" class="ms-1 btn_link btn_link-border btn_link-sm">Add</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col"><span><i class='bx bx-layer text-primary'></i></span> Attachements</div>
                    <div class="col">
                        <div class="d-flex align-items-center flex-wrap"><span class="text-primary d-flex"><i class='bx bx-folder me-1' ></i></span> 2 <span class="px-2">|</span> <span class="text-secondary d-flex"><i class='bx bx-file-blank me-1' ></i></span>4 <a href="#" class="ms-3 btn_link btn_link-border btn_link-sm">Add</a></div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="title-label">Teams</div>
                    <div class="btn-list">
                        <a href="#" class="btn-batch btn-batch-profile"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                        <a href="#" class="btn-batch btn-batch-profile"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                        <a href="#" class="btn-batch btn-batch-profile"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                    </div>
                </div>
                <hr>
                <div class="task_progress">
                    <div class="task_progress-head">
                        <div class="task_progress-head-title">Progress</div>
                        <div class="task_progress-head-days"><span><i class='bx bx-calendar-minus'></i></span> 45 Days Left</div>
                    </div>
                    <div class="task_progress-btm">
                        <div class="progress" role="progressbar" aria-label="Project Progress" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-success" style="width: 60%"><span class="progress-bar-text">60%</span></div>
                        </div>
                        <div class="task_progress-btm-date d-flex justify-content-between">
                            <div><i class='bx bx-calendar text-primary' ></i> 26 Jan 2024</div>
                            <div class="text-success"><i class='bx bx-calendar-check ' ></i> 30 March 2024</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="title-label d-flex align-items-center">Description <a href="#" class="ms-2 d-inline-flex"><i class='bx bx-pencil text-primary'></i></a></div>
                <div class="text-sm">The female circus horse-rider is a recurring subject in Chagall’s work. In 1926 the art dealer Ambroise Vollard invited Chagall to make a project based on the circus. They visited Paris’s historic Cirque d’Hiver Bouglione together; Vollard lent Chagall his private box seats. Chagall completed 19 gou... <a href="#" class="btn_link btn_link-primary">see more</a></div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="column-box h-100">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div><h4 class="column-title mb-0"><i class='bx bx-objects-horizontal-left text-primary' ></i> 60 Tasks</h4></div>
                    <div class="btn-list">
                        <a href="javascript:;" class="btn-sm btn-border" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class='bx bx-plus' ></i> Add Task</a>
                        <div class="cus_dropdown">
                            <div class="cus_dropdown-icon btn-border btn-border-secondary"><i class='bx bx-filter-alt' ></i> Filter</div>
                            <div class="cus_dropdown-body cus_dropdown-body-widh_l">
                                <div class="cus_dropdown-body-wrap">
                                    <div class="filterSort">
                                        <h5 class="filterSort-header"><i class='bx bx-sort-down text-primary' ></i> Sort By</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Newest</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Due Date</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch"><i class='bx bx-down-arrow-alt' ></i> A To Z</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch"><i class='bx bx-up-arrow-alt' ></i> Z To A</a></li>
                                        </ul>
                                        <hr>
                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <h5 class="filterSort-header mb-0"><i class='bx bx-calendar-alt text-primary'></i> Date</h5>
                                            <div>
                                                <a href="#" class="btn-batch">Start Date</a> <span class="px-2">to</span> <a href="#" class="btn-batch">End Date</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-sitemap text-primary' ></i> Teams</h5>
                                        <select class="form-control"name="" id="">
                                            <option value="Rakesh">Rakesh</option>
                                            <option value="Rajiv">Rajiv</option>
                                        </select>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> User</h5>
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
                <hr class="space-sm">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                    <div class="btn-list">
                        <a href="#" class="btn-border btn-border-sm btn-border-secondary active"><span><i class='bx bx-objects-horizontal-center' ></i></span> 30 Active</a>
                        <a href="#" class="btn-border btn-border-sm btn-border-danger"><span><i class='bx bx-objects-horizontal-center' ></i></span> 20 Overdue</a>
                        <a href="#" class="btn-border btn-border-sm btn-border-success"><span><i class='bx bx-objects-horizontal-center' ></i></span> 10 Completed</a>
                    </div>
                    </div>
                    <div class="col-lg-6 ms-auto text-end">
                        <form class="search-box search-box-float-style" action="">
                            <span class="search-box-float-icon"><i class='bx bx-search'></i></span>
                            <input type="text" class="form-control" placeholder="Search Task...">
                        </form>
                    </div>
                </div>
                <div class="taskList-dashbaord_header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="taskList-dashbaord_header_title taskList_col ms-2">Task Name</div>
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
                <div class="taskList scrollbar">
                    <div>
                        <div class="taskList_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>Acma Website Backup</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="taskList_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>Acma Website Backup</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="taskList_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>Acma Website Backup</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="taskList_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>Acma Website Backup</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="taskList_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>Acma Website Backup</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="taskList_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>Acma Website Backup</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="taskList_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>Acma Website Backup</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="taskList_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>Acma Website Backup</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="taskList_row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="taskList_col taskList_col_title">
                                        <div class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></div>
                                        <div>
                                            <div>Acma Website Backup</div>
                                            <div class="text-xs"><i class='bx bx-calendar-alt' ></i> 15 March 2024 | 12:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="taskList_col">
                                        <div class="avatarGroup avatarGroup-overlap">
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Kumar">
                                                    <img alt="avatar" src="{{ env('APP_URL') }}/storage/images/clients/Acma.png" class="rounded-circle" />
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">                                    
                                    <div class="btn-list justify-content-center">
                                        <a class="btn-icon btn-icon-rounded btn-icon-edit" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                        <a class="btn-icon btn-icon-rounded btn-icon-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <div class="btn-list">
                <button type="button" class="btn-batch btn-batch-secondary">Accepted</button>
                <button type="button" class="btn-batch btn-batch-success">Completed</button>
            </div>
            <div class="offcanvas-header-end">
                <button type="button" class="btn-icon"><i class='bx bx-check text-success' ></i></button>
                <button type="button" class="btn-icon" data-bs-toggle="modal" data-bs-target="#attached-file-modal"><i class='bx bx-paperclip' style="transform: rotate(60deg);"></i></button>
                <button type="button" class="btn-icon"><i class='bx bx-link' ></i></button>
                <button type="button" class="btn-icon"><i class='bx bx-fullscreen'></i></button>
                <button type="button" class="btn-icon"><i class='bx bx-trash'></i></button>
                <button type="button" class="btn-icon" data-bs-dismiss="offcanvas" aria-label="Close"><i class='bx bx-arrow-to-right'></i></button>
            </div>
        </div>
        <div class="offcanvas-body scrollbar">
            <form class="taskPane" action="">
                <div class="taskPane-head">
                    <div class="taskPane-heading">
                        <div class="taskPane-heading-label"><i class='bx bx-notepad text-primary'></i> Task Heading</div>
                        <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Write a task name">
                    </div>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="taskPane-body">
                    <div class="taskPane-item d-flex flex-wrap">
                        <div class="taskPane-item-left"><div class="taskPane-item-label">Assigned to</div></div>
                        <div class="taskPane-item-right">
                            <select name="" id="" class="users">
                                <option value="" disabled>Select User</option>
                                <option data-image="" value="">Rakesh Roshan</option>
                            </select>
                        </div>
                    </div>
                    <div class="taskPane-item d-flex flex-wrap">
                        <div class="taskPane-item-left"><div class="taskPane-item-label">Notify to</div></div>
                        <div class="taskPane-item-right">
                            <select name="" id="" class="users">
                                <option value="" disabled>Select User</option>
                                <option data-image="" value="">Rakesh Roshan</option>
                            </select>
                        </div>
                    </div>
                    <div class="taskPane-item d-flex flex-wrap">
                        <div class="taskPane-item-left"><div class="taskPane-item-label">Project</div></div>
                        <div class="taskPane-item-right">
                            <select name="" id="" class="users">
                                <option value="" disabled>Select User</option>
                                <option data-image="" value="">Rakesh Roshan</option>
                            </select>
                        </div>
                    </div>
                    <div class="taskPane-item d-flex flex-wrap">
                        <div class="taskPane-item-left"><div class="taskPane-item-label">Due Date</div></div>
                        <div class="taskPane-item-right">
                            <a href="#">
                                <div class="icon_rounded"><i class='bx bx-calendar' ></i></div>
                                <span class="btn_link">No Due Date</span>
                            </a>
                        </div>
                    </div>
                    <div class="taskPane-item">
                        <div class="taskPane-item-label mb-3">Description</div>
                        <div>
                            <textarea name="" id="editor" cols="30" rows="4" placeholder="Type Description"></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <div class="cmnt_sec">
                <!-- Activity -->
                <h5 class="cmnt_act_title"><span><i class='bx bx-line-chart text-primary'></i> Activity</span><span class="text-sm"><i class='bx bx-comment-dots text-secondary'></i> 15 Comments</span></h5>
                <div class="cmnt_act">
                    <div class="cmnt_act_row">
                        <div class="cmnt_act_user">
                            <div class="cmnt_act_user_img">
                                <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/images/users/Chetan%20Singh.png">
                            </div>
                            <div class="cmnt_act_user_name-wrap">
                                <div class="cmnt_act_user_name">Chetan Kumar</div>
                                <div class="cmnt_act_date">1 week ago</div>
                                <div class="cmnt_act_user_text">Add logo in the client section and make it live</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer">
            <div class="taskPane-footer-wrap">
                <button type="button" class="btn-border btn-sm btn-border-danger"><i class='bx bx-trash' ></i> Delete Task</button>
                <button type="button" class="btn-border btn-sm btn-border-primary ms-auto"><i class='bx bx-check'></i> Save Task</button>
            </div>
        </div>
    </div>

    <!-- Add File Modal  -->
    <div class="modal fade" id="attached-file-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-layer' ></i></span> <span class="project-form-text">Upload File Or Link</span></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Add Link</label>
                                    <input type="text" class="form-style mt-2" placeholder="Add Link...">
                                </div>
                            </div>
                            <div class="divider-or my-3 w-100"><span></span>OR<span></span></div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Upload Image <br/>Or File</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="form-file_upload form-file_upload-logo">
                                        <input type="file" id="formFile">
                                        <div class="form-file_upload-box">
                                            <div class="form-file_upload-box-icon"><i class='bx bx-image'></i></div>
                                            <div class="form-file_upload-box-text">Upload</div>
                                        </div>
                                        <div class="form-file_upload-valText">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary project-form-btn">Uplaod</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
