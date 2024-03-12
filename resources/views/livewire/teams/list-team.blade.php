<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Teams</li>
        </ol>
    </nav>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Teams</h3>
                <span class="text-light">|</span>
                <a data-bs-toggle="modal" data-bs-target="#add-team-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Team</a>
                <!-- <a wire:navigate href="{{ route('team.add') }}" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Team</a> -->
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Teams...">
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
                                            <li class="filterSort_item"><a href="#" class="btn-batch"><i class='bx bx-down-arrow-alt' ></i> A To Z</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch"><i class='bx bx-up-arrow-alt' ></i> Z To A</a></li>
                                        </ul>
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
        
        @foreach($teams as $team)
            <div class="col-md-4 mt-2">
                <div class="card_style card_style-team">
                    <!-- Edit -->
                    <div class="cus_dropdown cus_dropdown-edit">
                        <div class="cus_dropdown-icon"><i class='bx bx-dots-horizontal-rounded' ></i></div>
                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a wire:navigate href="{{ route('team.edit' , $team->id ) }}"><span class="text-secondary"><i class='bx bx-pencil' ></i></span> Edit</a></li>
                                    <li><a href="#"><span class="text-danger"><i class='bx bx-trash' ></i></span> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card_style-star_active"><span class="text-success"><i class='bx bxs-star' ></i></span></div>
                    <div class="card_style-list_head">
                        <div class="card_style-team-profile-img"><span><img src="{{ env('APP_URL') }}/storage/{{ $team->image }}" alt="{{ $team->name }}"></span></div>
                        <div class="card_style-team-profile-content">
                            <h4 class="mb-2"><a wire:navigate href="{{ route('team.profile') }}">{{ $team->name }}</a></h4>
                            <div class="mb-2">
                                <span class="font-500"><i class='bx bx-user text-success' ></i> Manager</span> <span class="btn-batch ms-2">Vikram Malhotra</span>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <div>15 Members</div>
                                </div>
                                <div class="col-auto px-0">
                                    <span class="text-dark-grey ms-1">|</span>
                                </div>
                                <div class="col">
                                    <div class="avatarGroup avatarGroup-overlap">
                                        @foreach($team->users as $user)
                                        <a href="#" class="avatarGroup-avatar">
                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" />
                                            </span>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="card_style-options">
                        <div class="card_style-options-head">
                            <span><i class='bx bx-layer text-secondary' ></i></span> 15 Projects <span class="text-dark-grey ms-1">|</span><span href="#" class="text-secondary"> <i class='bx bx-briefcase-alt-2' ></i></span> 5 Clients <span class="text-dark-grey ms-1">|</span> <span href="#"><i class='bx bx-objects-horizontal-left text-primary' ></i></span> 60 Tasks
                        </div>
                        <div class="card_style-options-head">
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagintaions mt-4">
            {{ $teams->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Team Modal -->
    <div wire:ignore class="modal fade" id="add-team-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-user' ></i></span> Add Team</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addProject" method="POST" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Team Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="project_name" type="text" class="form-style" placeholder="Team Name Here...">
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
                                    <label for="">Add Users<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <select name="" id="" class="form-style">
                                        <option value="">Rakesh</option>
                                        <option value="">Rajiv</option>
                                        <option value="">Akash</option>
                                    </select>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-md-4 mb-4 mb-lg-0">
                                    <label for="">Assign Manager<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8">
                                    <select name="" id="" class="form-style">
                                        <option value="">Rakesh</option>
                                        <option value="">Rajiv</option>
                                        <option value="">Akash</option>
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
</div>
