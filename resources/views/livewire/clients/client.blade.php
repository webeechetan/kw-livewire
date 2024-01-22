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
        <div class="col-md-7 mb-4">
            <div class="column-box h-100">
                <div class="column-head d-flex flex-wrap align-items-center mb-4">
                    <div>
                        <h5 class="mb-0">All Projects</h5>
                        <div class="text-light">{{ count($client->projects) }} Projects</div>
                    </div>
                    <form class="single-add ms-auto" method="POST" wire:submit.prevent="addProject()">
                        <div class="single-add-wrap" wire:ignore>
                            <input class="form-control" wire:model="project_name" type="text" placeholder="Add Project Here">
                            <a class="single-add-date" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Select Date"><i class='bx bx-calendar' ></i></a>
                        </div>
                        <button class="btn btn-sm btn-primary">Add Project</button>
                    </form>
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
        <div class="col-md-5 mb-4">
            <div class="column-box h-100">
                <div class="column-head d-flex flex-wrap align-items-center mb-4">
                    <div>
                        <h5 class="mb-0">Team</h5>
                        <div class="text-light">4 Teams Assigned</div>
                    </div>
                    <form class="single-add ms-auto" action="">
                        <div class="single-add-wrap">
                            <input class="form-control" wire:model="project_name" type="text" placeholder="Add Team Here">
                            <a class="single-add-date"  href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Select Date"><i class='bx bx-user-plus '></i></a>
                        </div>
                        <a href="javascript:void(0);" class="btn-sm btn-with_icon btn-primary">Add Team</a>
                    </form>
                </div>
                <!-- Teams -->
                <div class="team-list grid_col grid_col-repeat-2 gap-20">
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
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="column-box h-100 p-3">
                <div class="files-head column-head d-flex flex-wrap align-items-center mb-4">
                    <div>
                        <h5 class="mb-0">External Links</h5>
                        <div class="text-light"><span class="text-primary"><i class='bx bx-folder' ></i></span> 4 <span class="px-2">|</span> <span class="text-secondary"><i class='bx bx-file-blank' ></i></span> 42</div>
                    </div>
                    <div class="files-options">
                        <ul>
                            <li><a href="#"><span><i class='bx bx-plus'></i></span></a></li>
                            <li><a href="#"><span><i class='bx bx-trash' ></i></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="files-list files-list_2 mt-3">
                    <div class="files-folder selected">
                        <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                        <div class="files-folder-title">Buyers Guide</div>
                        <div class="files-folder-number">12</div>
                    </div>
                    <div class="files-folder">
                        <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                        <div class="files-folder-title">Startup Acma</div>
                        <div class="files-folder-number">12</div>
                    </div>
                    <div class="files-folder">
                        <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                        <div class="files-folder-title">Acma Webiste</div>
                        <div class="files-folder-number">12</div>
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
                                <div class="files-item-content-info">26 Jan 2024</div>
                            </div>
                        </div>
                        <div class="files-item">
                            <div class="files-item-icon">
                                <span><i class='bx bx-file-blank'></i></span>
                            </div>
                            <div class="files-item-content">
                                <div class="files-item-content-title">Tetrisly-guide-lines.png</div>
                                <div class="files-item-content-info">26 Jan 2024</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="column-box">
                <div class="column-head d-flex flex-wrap align-items-center mb-4">
                    <h5 class="mb-0">Files & Folders</h5>
                </div>
                <div id="fm" style="height: 600px;"></div>
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
