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
                        </div>
                    </div>
                    <hr>
                    <div class="card_style-user-body">
                        <div class="card_style-user-team">
                            <div class="card_style-user-title"><span><i class='bx bx-user-plus' ></i></span> Teams Assigned</div>
                            <div>
                                @foreach($user->teams as $team)
                                    <div class="btn-batch"><img src="{{ env('APP_URL') }}/storage/{{ $team->image }}" alt="{{ $team->name }}"> {{ $team->name }}</div>
                                @endforeach
                                <div class="btn-batch"><img src="http://localhost:8000/storage/images/teams/Tech%20Team.png" alt=""> Media Team</div>
                                <div class="btn-batch"><img src="http://localhost:8000/storage/images/teams/Tech%20Team.png" alt=""> CS Team</div>
                            </div>
                        </div>
                        <hr>
                        <div class="card_style-user-title"><span><i class='bx bx-objects-horizontal-left' ></i></span> 7 Projects Assigned</div>
                        <div class="card_style-projects_tab">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <div class="card_style-projects_tab-title active text-primary" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Active <span class="btn-batch-bg btn-batch-bg-primary ms-2">5 Projects</span></div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <div class="card_style-projects_tab-title text-success" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Completed <span class="btn-batch-bg btn-batch-bg-success ms-2">2 Projects</span></div>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="card_style-projects_tab-items">
                                        <span class="btn-batch">Acma Website</span>
                                        <span class="btn-batch">Buyers Guide</span>
                                        <span class="btn-batch">Prunell</span>
                                        <span class="btn-batch">Musco</span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div class="card_style-projects_tab-items">
                                        <span class="btn-batch btn-batch-success">Webeesocial</span>
                                        <span class="btn-batch">Buyers Guide</span>
                                        <span class="btn-batch">Prunell</span>
                                    </div>
                                </div>
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
