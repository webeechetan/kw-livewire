<div class="container">
    <!-- Dashboard Header -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h3 class="main-body-header-title mb-0">{{ $client->name }} Profile</h3>
            
        </div>
        <div class="text-end col">
            <div class="main-body-header-right">
                <form class="single-add ms-auto" action="">
                    <div class="single-add-wrap">
                        <input class="form-control" wire:model="name" type="text" placeholder="Add Project Here">
                        <a class="single-add-date" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Select Date"><i class='bx bx-calendar' ></i></a>
                    </div>
                    <a href="javascript:void(0);" class="btn-border btn-border-primary"><i class="bx bx-plus"></i> Add Project</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Dashboard Body -->

    <!-- Teams -->
    <div class="team-list">
        <!-- Team -->
        <div class="team team-style_2">
            <div class="team-style_2-head_wrap">
                <div class="team-avtar">
                    <span>DS</span>
                </div>
                <h4 class="team-style_2-title">Design</h4>
            </div>
            <div class="avatarGroup avatarGroup-overlap">
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajay Kumar">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle">
                    </span>
                </a>
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Roshan Jajoria">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Roshan Jajoria.png" class="rounded-circle">
                    </span>
                </a>
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Singh">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Chetan Singh.png" class="rounded-circle">
                    </span>
                </a>
            </div>
        </div>
        <!-- Team -->
        <div class="team team-style_2">
            <div class="team-style_2-head_wrap">
                <div class="team-avtar">
                    <span>TC</span>
                </div>
                <h4 class="team-style_2-title">Tech</h4>
            </div>
            <div class="avatarGroup avatarGroup-overlap">
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajay Kumar">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle">
                    </span>
                </a>
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Roshan Jajoria">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Roshan Jajoria.png" class="rounded-circle">
                    </span>
                </a>
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Singh">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Chetan Singh.png" class="rounded-circle">
                    </span>
                </a>
            </div>
        </div>
        <!-- Team -->
        <div class="team team-style_2">
            <div class="team-style_2-head_wrap">
                <div class="team-avtar">
                    <span>ME</span>
                </div>
                <h4 class="team-style_2-title">Media</h4>
            </div>
            <div class="avatarGroup avatarGroup-overlap">
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajay Kumar">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle">
                    </span>
                </a>
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Roshan Jajoria">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Roshan Jajoria.png" class="rounded-circle">
                    </span>
                </a>
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Singh">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Chetan Singh.png" class="rounded-circle">
                    </span>
                </a>
            </div>
        </div>
        <!-- Team -->
        <div class="team team-style_2">
            <div class="team-style_2-head_wrap">
                <div class="team-avtar">
                    <span>ME</span>
                </div>
                <h4 class="team-style_2-title">Media</h4>
            </div>
            <div class="avatarGroup avatarGroup-overlap">
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajay Kumar">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle">
                    </span>
                </a>
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Roshan Jajoria">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Roshan Jajoria.png" class="rounded-circle">
                    </span>
                </a>
                <a href="#" class="avatarGroup-avatar">
                    <span class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Chetan Singh">
                        <img alt="avatar" src="http://localhost:8000/storage/images/users/Chetan Singh.png" class="rounded-circle">
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="files-head">
                    <h5 class="mb-0">Files & Folders</h5>
                    <div class="files-options">
                        <ul>
                            <li><a href="#"><span><i class='bx bx-upload' ></i></span></a></li>
                            <li><a href="#"><span><i class='bx bx-trash' ></i></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="files-list files-list_2 mt-3">
                    <div class="files-folder">
                        <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                        <div class="files-folder-title">Moodward</div>
                        <div class="files-folder-number">12</div>
                    </div>
                    <div class="files-folder">
                        <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                        <div class="files-folder-title">Moodward</div>
                        <div class="files-folder-number">12</div>
                    </div>
                    <div class="files-folder">
                        <span class="files-folder-icon"><i class='bx bx-folder'></i></span>
                        <div class="files-folder-title">Moodward</div>
                        <div class="files-folder-number">12</div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="project-tabs">
                    <h5 class="mb-0">Projects</h5>
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
                            <div class="project project-align_left project-overdue">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Startup Acma</a>
                                    <div class="project-selected-date">Due on <span>30 Dec 2023</span></div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-selected-date">Due on <span>30 March 2024</span></div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-selected-date">Due on <span>30 March 2024</span></div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-selected-date">Due on <span>30 March 2024</span></div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-selected-date">Due on <span>30 March 2024</span></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project-done-tab-pane" role="tabpanel" aria-labelledby="project-done-tab" tabindex="0">
                        <div class="project-list project-list-completed">
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project-overdue-tab-pane" role="tabpanel" aria-labelledby="project-overdue-tab" tabindex="0">
                        <div class="project-list project-list-overdue">
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="project-archived-tab-pane" role="tabpanel" aria-labelledby="project-archived-tab" tabindex="0">
                        <div class="project-list project-list-archive">
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                            <div class="project project-align_left">
                                <div class="project-icon">
                                    <span class="d-inline-flex"><i class='bx bx-list-ul'></i></span>
                                </div>
                                <div class="project-content">
                                    <a href="#" class="project-title">Buyers Guide</a>
                                    <div class="project-dec">Contrary to popular belief, Lorem Ipsum is not simply random text...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
