<div class="container">
    <!-- Dashboard Header -->
    <div class="main-body-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="main-body-header-title mb-0">All Tasks</h3>
                <div class="tabNavigationBar-tab">
                    <a class="tabNavigationBar-item tabNavigationBar-item-active" href="javascript:;"><i class='bx bx-list-ul' ></i> List</a>
                    <a class="tabNavigationBar-item" wire:navigate href="{{ route('task.index') }}"><i class='bx bx-columns' ></i> Board</a>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="javascript:;" class="btn-border btn-border-primary toggleForm"><i class='bx bx-plus'></i> Add Task</a>
                        <a class="btn-border" href="#"><i class='bx bx-filter' ></i> Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="taskList-dashbaord">
        <div class="taskList-wrap">
            <div class="taskList-dashbaord_header">
                <div class="row">
                    <div class="col-md-4">
                        <div class="taskList-dashbaord_header_title taskList_col">Task Name</div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList-dashbaord_header_title taskList_col">Due Date</div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList-dashbaord_header_title taskList_col">Projects</div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList-dashbaord_header_title taskList_col">Assignee</div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList-dashbaord_header_title taskList_col">Notify</div>
                    </div>
                    <div class="col text-center">
                        <div class="taskList-dashbaord_header_title taskList_col">Status</div>
                    </div>
                </div>
            </div>
            <div class="taskList">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <div class="accordion-header taskList_row_wrap_head">
                            <span class="accordion-button taskList_row_wrap_head_title" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Assigned</span>
                        </div>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse taskList_row_wrap collapse show">
                            <div class="accordion-body">
                                @foreach($tasks['pending'] as $task)
                                    <div class="taskList_row">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="taskList_col taskList_col_title"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="taskList_col">{{  Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</div>
                                            </div>
                                            <div class="col text-center">
                                                @if($task->project)
                                                    <div class="taskList_col">{{ $task->project->name }}</div>
                                                @else
                                                    <div class="taskList_col">-</div>
                                                @endif
                                            </div>
                                            <div class="col text-center">
                                                <div class="taskList_col">
                                                    <div class="avatarGroup avatarGroup-overlap">
                                                        @foreach($task['users'] as $user)
                                                        <a href="#" class="avatarGroup-avatar">
                                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" />
                                                            </span>
                                                        </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="taskList_col">Notify</div>
                                            </div>
                                            <div class="col">
                                                <div class="taskList_col">
                                                    <div class="icon_group justify-content-center">
                                                        <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                        <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header taskList_row_wrap_head">
                            <span class="accordion-button taskList_row_wrap_head_title taskList_row_wrap_head_title_inProgress" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">In Progress</span>
                        </div>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse taskList_row_wrap collapse show">
                            <div class="accordion-body">
                                @foreach($tasks['in_progress'] as $task)
                                    <div class="taskList_row">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="taskList_col taskList_col_title"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="taskList_col">{{  Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</div>
                                            </div>
                                            <div class="col text-center">
                                                @if($task->project)
                                                    <div class="taskList_col">{{ $task->project->name }}</div>
                                                @else
                                                    <div class="taskList_col">-</div>
                                                @endif
                                            </div>
                                            <div class="col text-center">
                                                <div class="taskList_col">
                                                    <div class="avatarGroup avatarGroup-overlap">
                                                        @foreach($task['users'] as $user)
                                                        <a href="#" class="avatarGroup-avatar">
                                                            <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                                <img alt="avatar" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" class="rounded-circle" />
                                                            </span>
                                                        </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="taskList_col">Notify</div>
                                            </div>
                                            <div class="col">
                                                <div class="taskList_col">
                                                    <div class="icon_group justify-content-center">
                                                        <a class="btn-icon-rounded btn-icon-rounded-progress" href="javascript:void(0);"><i class='bx bx-pencil'></i></a>
                                                        <a class="btn-icon-rounded btn-icon-rounded-danger" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>