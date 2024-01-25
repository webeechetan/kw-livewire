<div class="container">
    <!-- Dashboard Header -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h3 class="main-body-header-title mb-0"><span class="client_head_logo"><img src="{{ env('APP_URL') }}/storage/{{ $client->image }}" alt=""></span> {{ $client->name }}</h3>
        </div>
        <div class="text-end col">
            <div class="main-body-header-right">
                <a href="javascript:void(0);" class="btn-border btn-border-primary"><i class="bx bx-plus"></i> Add Client</a>
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
                        <div class="text-light">{{ count($client->projects) }} Projects</div>
                    </div>
                    <div class="ms-auto">
                        <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bx bx-plus"></i> Add Project</a>
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
                            @foreach($active_projects as $project)
                                <div class="project project-align_left project-overdue">
                                    <div class="project-icon">
                                        <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                    </div>
                                    <div class="project-content">
                                        <a href="#" class="project-title">{{ $project->name }}</a>
                                        <div class="project-selected-date">Due on <span>{{ $project->due_date }}</span></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project-done-tab-pane" role="tabpanel" aria-labelledby="project-done-tab" tabindex="0">
                        <div class="project-list project-list-completed">
                            @foreach($completed_projects as $project)
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">{{ $project->name }}</a>
                                    <div class="project-dec">{{ $project->description }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project-overdue-tab-pane" role="tabpanel" aria-labelledby="project-overdue-tab" tabindex="0">
                        <div class="project-list project-list-overdue">
                            @foreach($overdue_projects as $project)
                                <div class="project project-align_left">
                                    <div class="project-icon">
                                        <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                    </div>
                                    <div class="project-content">
                                        <a href="#" class="project-title">{{ $project->name }}</a>
                                        <div class="project-dec">{{ $project->description }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project-archived-tab-pane" role="tabpanel" aria-labelledby="project-archived-tab" tabindex="0">
                        <div class="project-list project-list-archive">
                            @foreach($archived_projects as $project)
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">{{ $project->name }}</a>
                                    <div class="project-dec">{{ $project->description }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="column-box h-100">
                <div class="column-head d-flex flex-wrap align-items-center mb-4">
                    <div>
                        <h5 class="mb-0">Teams</h5>
                        <div class="text-light">4 Teams Assigned</div>
                    </div>
                    <div class="ms-auto">
                        <a class="btn-icon btn-icon-primary" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="bx bx-plus"></i></a>
                    </div>
                    <!-- <form class="single-add ms-auto" action="">
                        <div class="single-add-wrap">
                            <input class="form-control" wire:model="project_name" type="text" placeholder="Add Team Here">
                            <a class="single-add-date"  href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Select Date"><i class='bx bx-user-plus '></i></a>
                        </div>
                        <a href="javascript:void(0);" class="btn-sm btn-with_icon btn-primary">Add Team</a>
                    </form> -->
                </div>
                <div class="team-scroll">
                    <!-- Teams -->
                    <div class="team-list">
                        <!-- Team -->
                        <div class="team team-style_2">
                            <div class="team-style_2-head_wrap">
                                <div class="team-avtar">
                                    <span>DS</span>
                                </div>
                                <h4 class="team-style_2-title">Design <span class="team-style_2-memCount">6 Members</span></h4>
                            </div>
                        </div>
                        <!-- Team -->
                        <div class="team team-style_2">
                            <div class="team-style_2-head_wrap">
                                <div class="team-avtar">
                                    <span>TC</span>
                                </div>
                                <h4 class="team-style_2-title">Tech <span class="team-style_2-memCount">12 Members</span></h4>
                            </div>
                        </div>
                        <!-- Team -->
                        <div class="team team-style_2">
                            <div class="team-style_2-head_wrap">
                                <div class="team-avtar">
                                    <span>ME</span>
                                </div>
                                <h4 class="team-style_2-title">Media <span class="team-style_2-memCount">6 Members</span></h4>
                            </div>
                        </div>
                        <!-- Team -->
                        <div class="team team-style_2">
                            <div class="team-style_2-head_wrap">
                                <div class="team-avtar">
                                    <span>CP</span>
                                </div>
                                <h4 class="team-style_2-title">Copy <span class="team-style_2-memCount">6 Members</span></h4>
                            </div>
                        </div>
                        <!-- Team -->
                        <div class="team team-style_2">
                            <div class="team-style_2-head_wrap">
                                <div class="team-avtar">
                                    <span>CP</span>
                                </div>
                                <h4 class="team-style_2-title">Copy <span class="team-style_2-memCount">6 Members</span></h4>
                            </div>
                        </div>
                        <!-- Team -->
                        <div class="team team-style_2">
                            <div class="team-style_2-head_wrap">
                                <div class="team-avtar">
                                    <span>CP</span>
                                </div>
                                <h4 class="team-style_2-title">Copy <span class="team-style_2-memCount">6 Members</span></h4>
                            </div>
                        </div>
                        <!-- Team -->
                        <div class="team team-style_2">
                            <div class="team-style_2-head_wrap">
                                <div class="team-avtar">
                                    <span>CP</span>
                                </div>
                                <h4 class="team-style_2-title">Copy <span class="team-style_2-memCount">6 Members</span></h4>
                            </div>
                        </div>
                        <div class="team">
                            <a class="btn btn-sm btn-border-primary w-100" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="bx bx-plus"></i> Add Team</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="column-box h-100 p-3">
                <div class="files-head column-head d-flex flex-wrap align-items-center mb-3">
                    <div>
                        <h5 class="mb-0">Files & Folders</h5>
                        <div class="text-light"><span class="text-primary"><i class='bx bx-folder' ></i></span> 4 <span class="px-2">|</span> <span class="text-secondary"><i class='bx bx-file-blank' ></i></span> 42</div>
                    </div>
                    <div class="files-options ms-auto">
                        <div class="btn-list gap-10">
                            <a href="#" class="btn btn-sm btn-border-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3"><span><i class='bx bx-plus'></i></span> Add File</a>
                            <a href="#" class="btn btn-sm btn-border-danger"><span><i class='bx bx-trash' ></i></span> Delete</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav>
                </div>
                <div class="files-list">
                    <div class="files-folder">
                        <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                        <div class="files-folder-title">Buyers Guide</div>
                        <div class="text-light"><span class="text-primary"><i class='bx bx-folder' ></i></span> 4 <span class="px-2">|</span> <span class="text-secondary"><i class='bx bx-file-blank' ></i></span> 42</div>
                    </div>
                    <div class="files-folder selected">
                        <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                        <div class="files-folder-title">Startup Acma</div>
                        <div class="text-light"><span class="text-primary"><i class='bx bx-folder' ></i></span> 4 <span class="px-2">|</span> <span class="text-secondary"><i class='bx bx-file-blank' ></i></span> 42</div>
                    </div>
                    <div class="files-folder">
                        <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                        <div class="files-folder-title">Acma Webiste</div>
                        <div class="text-light"><span class="text-primary"><i class='bx bx-folder' ></i></span> 4 <span class="px-2">|</span> <span class="text-secondary"><i class='bx bx-file-blank' ></i></span> 42</div>
                    </div>
                    <div class="files-folder files-folder-add_new">
                        <span class="files-folder-icon"><i class='bx bx-plus' ></i></span>
                        <div class="files-folder-title">Add Folder</div>
                    </div>
                </div>
                <div class="files-items-wrap">
                    <div class="files-items-head column-head mb-4">
                        <h5 class="title-sm mb-0">Recent Files</h5>
                        <!-- <form class="ms-auto" action="">
                            <div class="search-box">
                                <input class="form-control" type="text" placeholder="Search File...">
                                <span class="search-box-icon"><i class='bx bx-search' ></i></span>   
                            </div>
                        </form> -->
                    </div>
                    <div class="files-items">
                        <div class="files-item">
                            <div class="files-item-icon">
                                <span><i class='bx bx-file-blank'></i></span>
                            </div>
                            <div class="files-item-content">
                                <div class="files-item-content-title">Tetrisly-guide-lines.png</div>
                            </div>
                        </div>
                        <div class="files-item selected">
                            <div class="files-item-icon">
                                <span><img src="{{ env('APP_URL') }}/assets/images/google-sheets-icon.svg" alt=""></span>
                            </div>
                            <div class="files-item-content">
                                <div class="files-item-content-title">Tetrisly-guide-lines.sheet</div>
                            </div>
                        </div>
                        <div class="files-item">
                            <div class="files-item-icon">
                                <span><img src="{{ env('APP_URL') }}/assets/images/google-docs-icon.svg" alt=""></span>
                            </div>
                            <div class="files-item-content">
                                <div class="files-item-content-title">Tetrisly-guide-lines.doc</div>
                            </div>
                        </div>
                        <div class="files-item">
                            <div class="files-item-icon">
                                <span><img src="{{ env('APP_URL') }}/assets/images/google-docs-icon.svg" alt=""></span>
                            </div>
                            <div class="files-item-content">
                                <div class="files-item-content-title">Tetrisly-guide-lines.doc</div>
                            </div>
                        </div>
                        <div class="files-item">
                            <div class="files-item-icon">
                                <span><i class='bx bx-file-blank'></i></span>
                            </div>
                            <div class="files-item-content">
                                <div class="files-item-content-title">Tetrisly-guide-lines.png</div>
                            </div>
                        </div>
                        <div class="files-folder files-folder-add_new">
                            <span class="files-folder-icon"><i class='bx bx-plus' ></i></span>
                            <div class="files-folder-title">Add Files</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-data'></i></span> Add Project</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Project Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input type="text" class="form-style" placeholder="Project Name Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Date</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="btn-list btn-list-full-2 justify-content-between gap-10">
                                        <button type="button" class="btn btn-50 btn-sm btn-border-secondary"><i class='bx bx-calendar-alt' ></i> Start Date</button>
                                        <button type="button" class="btn btn-50 btn-sm btn-border-danger"><i class='bx bx-calendar-alt' ></i> Due Date</button>
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
                                    <button type="submit" class="btn btn-primary">Add Project</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-group' ></i></span> Add Team</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Team</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input type="text" class="form-style" placeholder="Select Team Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Users</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input type="text" class="form-style" placeholder="Select Usres Here...">
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

    <!-- File Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-group' ></i></span> Add Files</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <div class="form-file_upload form-file_upload-doc">
                                        <input type="file" id="formFile">
                                        <div class="form-file_upload-box">
                                            <div class="form-file_upload-box-icon"><i class='bx bx-images' ></i></div>
                                            <div class="form-file_upload-box-text">Upload Images</div>
                                        </div>
                                        <div class="form-file_upload-valText text-center">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Folder</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input type="text" class="form-style" placeholder="Select Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Sub Folder</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input type="text" class="form-style" placeholder="Select Here...">
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
@push('scripts')
<script>
    $(function () {
        $('[data-bs-toggle="tooltip"]').tooltip()
    })
    $('.single-add-date').flatpickr({
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            $(".single-add-date").html(dateStr);
            @this.set('project_due_date', dateStr);
        },
    });
</script>
@endpush
