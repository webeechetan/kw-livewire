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
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Newest</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Due Date</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch"><i class='bx bx-down-arrow-alt' ></i> A To Z</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch"><i class='bx bx-up-arrow-alt' ></i> Z To A</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Status</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Active</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Overdue</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Completed</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Archived</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                                        <select class="form-control"name="" id="">
                                            <option value="Rakesh">Rakesh</option>
                                            <option value="Rajiv">Rajiv</option>
                                        </select>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By User</h5>
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
        @foreach($projects as $project)
            <div class="col-md-4">
                <div class="card_style card_style-project">
                    <!-- Edit -->
                    <div class="cus_dropdown cus_dropdown-edit">
                        <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a wire:navigate href="{{ route('project.edit',$project->id) }}"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                    <li><a wire:confirm="Are you sure you want to delete this project?" wire:click="delete({{ $project->id }})"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card_style-project-head">
                {{-- <div class="card_style-project-head-client"><span><i class='bx bx-user'></i></span> {{ $project->client->name }}</div> --}}
                        <h4><a href="{{ route('project.profile') }}" wire:navigate>{{ $project->name }}</a></h4>
                        <!-- Avatar Group -->
                        <div class="avatarGroup avatarGroup-lg avatarGroup-overlap mt-2">
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
                        </div>
                    </div>
                    <div class="card_style-project-body">
                        <div class="card_style-project-options">
                            <div><span><i class='bx bx-layer' ></i></span> 5 Attachements</div>
                            <div><span><i class='bx bx-calendar' ></i></span> 3 Months</div>
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
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagintaions mt-4">
            {{ $projects->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
    
    <!-- Project Modal -->
    <div wire:ignore class="modal fade" id="add-project-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-layer' ></i></span> Add Project</h3>
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
                                    <label for="">Add Users</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <select name="" id="">
                                        <option value="">Rakesh</option>
                                        <option value="">Rajiv</option>
                                        <option value="">Akash</option>
                                    </select>
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
