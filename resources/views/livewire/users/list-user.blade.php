<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Users</li>
        </ol>
    </nav>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Users</h3>
                <span class="text-light">|</span>
                <a wire:navigate href="{{ route('user.add') }}" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add User</a>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Users...">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">        
        @foreach($users as $user)
            <div class="col-md-4">
                <div class="card_style card_style-user">
                    <!-- Edit -->
                    <div class="cus_dropdown cus_dropdown-edit">
                        <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a href="#"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                    <li><a href="#"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card_style-user-head">
                        <div class="card_style-user-profile-img"><span><img src="{{ env('APP_URL') }}/storage/{{ $user->image }}" alt="{{ $user->name }}"></span></div>
                        <div class="card_style-user-profile-content">
                            <h4><a href="#">{{ $user->name }}</a></h4>
                            <div class="d-flex align-items-center"><i class='bx bx-envelope me-1 text-secondary' ></i> {{ $user->email }}</div>
                            <div class="card_style-user-head-position mt-2"><i class='bx bx-user'></i> Web Developer | Tech Team</div>
                            <div class="mt-2">Assigned <span class="btn-batch btn-batch-warning">5 Teams</span></div>
                        </div>
                    </div>
                    <hr>
                    <div class="card_style-user-body">
                        <div class="card_style-options">
                            <div class="card_style-options-head"><span><i class='bx bx-layer text-secondary' ></i></span> 30 Projects</div>
                            <div class="card_style-options-list d-flex">
                                <div class="text-primary">Active <span class="btn-batch-bg btn-batch-bg-primary">10 Projects</span></div>
                                <div class="text-success ms-4">Completed <span class="btn-batch-bg btn-batch-bg-success">5 Projects</span></div>
                            </div>
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
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagintaions mt-4">
            {{ $users->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
