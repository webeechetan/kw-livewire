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
                <a wire:navigate href="{{ route('project.add') }}" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Project</a>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Projects...">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        @foreach($projects as $project)
            <div class="col-md-4">
                <div class="card_style card_style-project">
                    <!-- Edit -->
                    <div class="cus_dropdown">
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
                        <div class="card_style-project-head-client"><span><i class='bx bx-user'></i></span> {{ $project->client->name }}</div>
                        <h4><a href="#">{{ $project->name }}</a></h4>
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
                            <div class="card_style-tasks-title"><span><i class='bx bx-objects-horizontal-left' ></i></span> 60 Tasks Assigned</div>
                            <div class="card_style-tasks-list">
                                <div class="card_style-tasks-item card_style-tasks-item-pending"><span><i class='bx bx-objects-horizontal-center' ></i></span> 30 Active</div>
                                <div class="card_style-tasks-item card_style-tasks-item-overdue"><span><i class='bx bx-objects-horizontal-center' ></i></span> 20 Overdue</div>
                                <div class="card_style-tasks-item card_style-tasks-item-done"><span><i class='bx bx-objects-horizontal-center' ></i></span> 10 Completed</div>
                            </div>
                        </div>
                        <hr>
                        <div class="card_style-progress">
                            <div class="card_style-progress-head">
                                <div class="card_style-progress-head-title">Progress</div>
                                <div class="card_style-progress-head-days"><span><i class='bx bx-calendar-minus'></i></span> 45 Days Left</div>
                            </div>
                            <div class="card_style-progress-btm">
                                <div class="progress" role="progressbar" aria-label="Project Progress" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-success" style="width: 60%"><span class="progress-bar-text">60%</span></div>
                                </div>
                                <div class="card_style-progress-btm-date d-flex justify-content-between">
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
</div>
