<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a wire:navigate href="{{ route('dashboard') }}">
                <i class='bx bx-line-chart'></i> Dashboard </a>
            </li>
            <li class="breadcrumb-item">
                <a wire:navigate href="{{ route('team.index') }}">All Team</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tech Team</li>
        </ol>
    </nav>
    <livewire:teams.components.teams-tab :team="$team" @saved="$refresh"/>
    <!--- Dashboard Body --->
    <div class="row mb-4">
        <div class="col-sm-3">
            <div class="column-box">
                <label for="" class="font-500"><i class='bx bx-briefcase-alt-2 text-primary' ></i> Filter By Client</label>
                <select class="dashboard_filters-select mt-2 w-100" name="" id="">
                    <option value="" disabled="">Select Client</option>
                    <option value="1">Acma</option>
                    <option value="2">Buyers Guide</option>
                    <option value="3">GRG</option>
                    <option value="4">Webeesocial</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="column-box">
                <label for="" class="font-500"><i class='bx bx-objects-horizontal-left text-warning' ></i> Filter By Project</label>
                <select class="dashboard_filters-select mt-2 w-100" name="" id="">
                    <option value="" disabled="">Select Client</option>
                    <option value="1">Acma</option>
                    <option value="2">Buyers Guide</option>
                    <option value="3">GRG</option>
                    <option value="4">Webeesocial</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="column-box">
                <label for="" class="font-500"><i class='bx bx-user text-secondary'></i> Filter By User</label>
                <select class="dashboard_filters-select mt-2 w-100" name="" id="">
                    <option value="" disabled="">Select Client</option>
                    <option value="1">Acma</option>
                    <option value="2">Buyers Guide</option>
                    <option value="3">GRG</option>
                    <option value="4">Webeesocial</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="column-box">
                <label for="" class="font-500"><i class='bx bx-calendar-alt text-success' ></i> Filter By Date</label>
                <input type="date" class="dashboard_filters-select mt-2 w-100">
            </div>
        </div>
    </div>
    <div class="project-tabs mb-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="project-all-tab" data-bs-toggle="tab" data-bs-target="#project-all-tab-pane" type="button" role="tab" aria-controls="project-all-tab-pane" aria-selected="true">All <span class="ms-2">{{ $team->projects->count() }}</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="false" tabindex="-1">Active <span class="ms-2">
                    {{ $team->projects->where('status','active')->count() }}   
                </span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-done-tab" data-bs-toggle="tab" data-bs-target="#project-done-tab-pane" type="button" role="tab" aria-controls="project-done-tab-pane" aria-selected="false" tabindex="-1">Completed <span class="ms-2">{{ $team->projects->where('status','completed')->count() }}   </span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-overdue-tab" data-bs-toggle="tab" data-bs-target="#project-overdue-tab-pane" type="button" role="tab" aria-controls="project-overdue-tab-pane" aria-selected="false" tabindex="-1">Overdue <span class="ms-2">{{ $team->projects->where('status','overdue')->count() }}   </span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-archived-tab" data-bs-toggle="tab" data-bs-target="#project-archived-tab-pane" type="button" role="tab" aria-controls="project-archived-tab-pane" aria-selected="false" tabindex="-1">Archive <span class="ms-2">{{ $team->projects->where('status','archived')->count() }}   </span></button>
            </li>
        </ul>
    </div>
    <div class="column-box">
        <div class="taskList-dashbaord_header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="taskList-dashbaord_header_title taskList_col ms-2">Task Name</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Created Date</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Due Date</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Project</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Assignee</div>
                </div>
            </div>
        </div>
        <div class="taskList scrollbar">
            <div class="taskList_row">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="taskList_col taskList_col_title">
                            <div class="edit-task" data-id="100">
                                <div>Abdul Pranay Jain</div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col"><span>10 Apr-2024</span></div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col"><span>12 Aug-1997</span></div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col"><span>Tanuja Lall</span></div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col">
                            <div class="avatarGroup avatarGroup-overlap">
                                <a href="#" class="avatarGroup-avatar">
                                    <span class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Azhar Vala">AV</span>
                                </a>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="taskList_row">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="taskList_col taskList_col_title">
                            <div class="edit-task" data-id="100">
                                <div>Abdul Pranay Jain</div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col"><span>10 Apr-2024</span></div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col"><span>12 Aug-1997</span></div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col"><span>Tanuja Lall</span></div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col">
                            <div class="avatarGroup avatarGroup-overlap">
                                <a href="#" class="avatarGroup-avatar">
                                    <span class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Azhar Vala">AV</span>
                                </a>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="taskList_row">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="taskList_col taskList_col_title">
                            <div class="edit-task" data-id="100">
                                <div>Abdul Pranay Jain</div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col"><span>10 Apr-2024</span></div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col"><span>12 Aug-1997</span></div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col"><span>Tanuja Lall</span></div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList_col">
                            <div class="avatarGroup avatarGroup-overlap">
                                <a href="#" class="avatarGroup-avatar">
                                    <span class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Azhar Vala">AV</span>
                                </a>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>