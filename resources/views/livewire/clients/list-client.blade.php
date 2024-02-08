<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Clients</li>
        </ol>
    </nav>
    <div class="dashboard-head">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Clients</h3>
                <span class="text-light">|</span>
                <a wire:navigate href="{{ route('client.add') }}" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Client</a>
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Clients...">
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
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a href="#" class="btn-batch active">Active</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Completed</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Archived</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By Projects</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Active</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Completed</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Archived</a></li>
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
        @foreach($clients as $client)
        <div class="col-md-4">
            <div class="card_style card_style-client">
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
                <div class="card_style-client-head">
                    <div><img src="{{ asset('storage/'.$client->image) }}" alt="" class="img-fluid"></div>
                    <div>
                        <h4><a wire:navigate href="{{ route('client.profile', $client->id ) }}">{{ $client->name }}</a></h4>
                        <div class="btn-withIcon"><i class='bx bx-layer text-secondary' ></i> 7 Projects</div>
                    </div>
                </div>
                <div class="card_style-client-body">
                    <div class="card_style-projects_tab">
                        <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <div class="card_style-projects_tab-title active text-primary" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Active <span class="btn-batch-bg btn-batch-bg ms-2">5 Projects</span></div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <div class="card_style-projects_tab-title text-success" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Completed <span class="btn-batch-bg btn-batch-bg-success ms-2">2 Projects</span></div>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="card_style-projects_tab-scroll">
                                    <div class="card_style-projects_tab-items">
                                        <!-- Avatar Group (Add + More option after 6) -->
                                        <div class="avatarGroup avatarGroup-lg mt-2">
                                            @foreach($client->projects as $project)
                                            <a href="#" class="avatarGroup-avatar">
                                                <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajay Kumar">
                                                    <img alt="avatar" src="{{ asset('storage/'.$client->image) }}" class="rounded-circle">
                                                </span>
                                            </a>
                                            @endforeach
                                        </div>
                                        <!-- <a href="#" class="btn-batch">{{ $project->name }}</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="card_style-projects_tab-scroll">
                                    <div class="card_style-projects_tab-items">
                                        @foreach($client->projects as $project)
                                            <a href="#" class="btn-batch btn-batch-success">{{ $project->name }}</a>
                                        @endforeach
                                        <span class="btn-batch">+ 5 More</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="pagintaions mt-4">
            {{ $clients->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Client Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-user'></i></span> Add Client</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Client Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input type="text" class="form-style" placeholder="Client Name Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Onboard Date</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="btn-list btn-list-full-2 justify-content-between gap-10">
                                        <button type="button" class="btn btn-50 btn-sm btn-border-secondary"><i class='bx bx-calendar-alt' ></i> Select Date</button>
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
                                    <textarea type="text" class="form-style" placeholder="Add Project Description Here..." rows="2" cols="30"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Document Upload</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-file_upload form-file_upload-doc">
                                        <input type="file" id="formFile">
                                        <div class="form-file_upload-box">
                                            <div class="form-file_upload-box-icon"><i class='bx bx-images' ></i></div>
                                            <div class="form-file_upload-box-text">Upload Images</div>
                                        </div>
                                        <div class="form-file_upload-valText">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary">Add Client</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
