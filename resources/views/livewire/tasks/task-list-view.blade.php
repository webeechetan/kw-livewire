<div class="container">
    <!-- Dashboard Header -->
    <div class="main-body-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="main-body-header-title mb-0">All Tasks</h3>
                <div class="tabNavigationBar-tab">
                    <a class="tabNavigationBar-item tabNavigationBar-item-active" href="javascript:void(0);"><i class='bx bx-list-ul' ></i> List</a>
                    <a class="tabNavigationBar-item" wire:navigate href="{{ route('task.index') }}"><i class='bx bx-columns' ></i> Board</a>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="javascript:void(0);" class="btn-border btn-border-primary toggleForm"><i class='bx bx-plus'></i> Add Task</a>
                        <a class="btn-border btn-border-secondary" href="#"><i class='bx bx-filter' ></i> Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="taskList-dashbaord">
        <div class="taskList-wrap">
            <div class="taskList-dashbaord_tabs">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="task_list_tab_assigned-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_assigned" type="button" role="tab" aria-controls="task_list_tab_assigned" aria-selected="true">Assigned</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task_list_tab_progress-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_progress" type="button" role="tab" aria-controls="task_list_tab_progress" aria-selected="false">In Progress</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task_list_tab_review-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_review" type="button" role="tab" aria-controls="task_list_tab_review" aria-selected="false">In Review</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task_list_tab_complete-tab" data-bs-toggle="pill" data-bs-target="#task_list_tab_complete" type="button" role="tab" aria-controls="task_list_tab_complete" aria-selected="false">Completed</button>
                    </li>
                </ul>
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
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="task_list_tab_assigned" role="tabpanel" aria-labelledby="task_list_tab_assigned-tab" tabindex="0">
                        <div class="taskList">
                            @foreach($tasks['pending'] as $task)
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm({{$task['id']}})"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="taskList_col"><span class="btn-batch">{{  Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</span></div>
                                        </div>
                                        <div class="col text-center">
                                            @if($task->project)
                                                <div class="taskList_col"><span class="btn-batch">{{ $task->project->name }}</span></div>
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
                    <div class="tab-pane fade" id="task_list_tab_progress" role="tabpanel" aria-labelledby="task_list_tab_progress-tab" tabindex="0">
                        <div>
                            @foreach($tasks['in_progress'] as $task)
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm({{$task['id']}})"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
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
                                            <div class="taskList_col">
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
                    <div class="tab-pane fade" id="task_list_tab_review" role="tabpanel" aria-labelledby="task_list_tab_review-tab" tabindex="0">
                        <div>
                            @foreach($tasks['in_review'] as $task)
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm({{$task['id']}})"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
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
                                            <div class="taskList_col">
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
                    <div class="tab-pane fade" id="task_list_tab_complete" role="tabpanel" aria-labelledby="task_list_tab_complete-tab" tabindex="0">
                        <div>
                            @foreach($tasks['completed'] as $task)
                                <div class="taskList_row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="taskList_col taskList_col_title" wire:click="enableEditForm({{$task['id']}})"><span class="taskList_col_title_complete_icon"><i class='bx bx-check'></i></span> {{ $task->name }}</div>
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
                                            <div class="taskList_col">
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

    
    {{-- Add task canvas --}}
    @if($view_form)
    <div class="AddCanvas">
        <!-- Add Task Canvas Header -->
        <div class="AddTask_head">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="AddTask_title-wrap">
                        <div class="AddTask_title-icon"><i class='bx bx-notepad'></i></div>
                        <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Type your task here...">
                    </div>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="#" wire:click="store" class="btn-border btn-border-primary"><i class='bx bx-check'></i> Save</a>
                        <a  wire:click="toggleForm" class="btn-border"><i class='bx bx-x' ></i> Close</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Task Canvas Body -->
        <div class="AddTask_body">
            <div class="AddTask_body_overview">
                <form  method="POST">
                    <div class="AddTask_rulesOverview">
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Assigned to</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select name="" id="" class="form-control users" multiple>
                                    <option value="" disabled>Select User</option>
                                    @foreach($users as $user)
                                        <option data-image="{{ $user->image }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Notify to</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select name="" id="" class="form-control users" multiple>
                                    <option value="" disabled>Select User</option>
                                    @foreach($users as $user)
                                        <option data-image="{{ $user->image }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Project</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select  id="project_id" class="form-control">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Due Date</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="rulesAction_group">
                                            {{-- <input type="date" wire:model="dueDate" class="form-control" > --}}
                                            <a href="#" class="rulesAction-item-date rulesAction_group-item">
                                                <div class="icon_rounded"><i class='bx bx-calendar' ></i></div>
                                                <span class="btn_link add_date_btn">Add Date</span>
                                            </a>
                                            {{-- <a href="#" class="icon_rounded rulesAction_group-item"><i class='bx bx-repeat'></i></a>    --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Description</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <textarea name="" id="editor" cols="30" rows="10"></textarea>
                            </div>
                        </div>
    
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- edit task canvas --}}
    @if($edit_task)
    <div class="AddCanvas">
        <!-- edit Task Canvas Header -->
        <div class="AddTask_head">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="AddTask_title-wrap">
                        <div class="AddTask_title-icon"><i class='bx bx-notepad'></i></div>
                        <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Type your task here...">
                    </div>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="#" wire:click="updateTask" class="btn-border btn-border-primary"><i class='bx bx-check'></i> Update</a>
                        <a href="{{ route('task.list-view') }}" wire:navigate class="btn-border"><i class='bx bx-x' ></i> Close</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit Task Canvas Body -->
        <div class="AddTask_body">
            <div class="AddTask_body_overview">
                <form  method="POST">
                    <div class="AddTask_rulesOverview">
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Assigned to</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select name="" id="" class="form-control users" multiple>
                                    <option value="" disabled>Select User</option>
                                    @foreach($users as $user)
                                            @if(in_array($user->id, $user_ids))
                                                <option data-image="{{ $user->image }}" value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                            @else
                                                <option data-image="{{ $user->image }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Notify to</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select name="" id="" class="form-control users" multiple>
                                    <option value="" disabled>Select User</option>
                                    @foreach($users as $user)
                                        @if(in_array($user->id, $user_ids))
                                            <option data-image="{{ $user->image }}" value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                        @else
                                            <option data-image="{{ $user->image }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Project</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <select  id="project_id" class="form-control">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                        <option @if($project_id == $project->id) selected @endif value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Due Date</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="rulesAction_group">
                                            {{-- <input type="date" wire:model="dueDate" class="form-control" > --}}
                                            <a href="#" class="rulesAction-item-date rulesAction_group-item">
                                                <div class="icon_rounded"><i class='bx bx-calendar' ></i></div>
                                                <span class="btn_link add_date_btn">{{ $dueDate }}</span>
                                            </a>
                                            {{-- <a href="#" class="icon_rounded rulesAction_group-item"><i class='bx bx-repeat'></i></a>    --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Description</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <textarea name="" id="editor" cols="30" rows="10">{{ $description }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="AddTask_body_overview">
                    <div class="AddTask_rulesOverview">
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Comments</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <textarea name="" id="comment_box" cols="30" rows="5"></textarea>
                            </div>
                            <div class="AddTask_rulesOverview_item_name mt-3"></div>
                            <div class="AddTask_rulesOverview_item_rulesAction mt-3">
                                <button wire:click="saveComment" class="btn btn-primary btn-sm"><i class="bx bx-comment"></i></button>
                            </div>
                        </div>
                        {{-- comments --}}
                        @foreach( $comments as $comment)
                        <div class="AddTask_rulesOverview_item">
                            <div class="AddTask_rulesOverview_item_name">
                                <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/{{ $user->image }}" alt="" height="50" width="50">
                                {{ $comment->user->name }}
                                <br>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                {!! $comment->comment !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


@push('scripts')
    <script>
        if(typeof users_for_mention === 'undefined'){
            var users_for_mention = [];
            var users = @json($users);
            users.forEach(user => {
                users_for_mention.push(user.name);
            });
        }else{
            var users_for_mention = users_for_mention;
            var users = @json($users);
        }

        $(document).ready(function(){
            $(".accordion-header").click(function(){
                // toggle div below one which is clicked
                $(this).next(".accordion-collapse").toggle(function(){
                    // add animation when toggling
                    if($(this).is(":visible")){
                        $(this).animate({
                            opacity: "1"
                        }, "slow");
                    } else {
                        $(this).animate({
                            opacity: "0"
                        }, "slow");
                    }
                });
            });
        });

        $(".toggleForm").click(function(){
            @this.toggleForm();
        });

        // File manager button (image icon)

        if(typeof FMButton === 'undefined'){
            var FMButton = function(context) {
                const ui = $.summernote.ui;
                const button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'File Manager',
                    click: function() {
                    window.open('/file-manager/summernote', 'fm', 'width=1400,height=800');
                    }
                });
                return button.render();
            };
        }else{
            var FMButton = FMButton;
        }

        // set file link
        function fmSetLink(url) {
            $('#editor').summernote('insertImage', url);
            $('#comment_box').summernote('insertImage', url);
        }

        function initPlugins(){
                $("#editor").summernote({
                    height: 200,
                    hint: {
                        mentions: users_for_mention,
                        match: /\B@(\w*)$/,
                        search: function (keyword, callback) {
                            callback($.grep(this.mentions, function (item) {
                                return item.indexOf(keyword) == 0;
                            }));
                        },
                        template : function (item) {
                            return '<img src="{{ env('APP_URL') }}/storage/' + users[users_for_mention.indexOf(item)].image + '" class="img-fluid rounded-circle" style="width: 20px; height: 20px; margin-right: 5px;"/>' + item;
                        },
                        content: function (item) {
                            item = item.replace(/\s/g, '_');
                            return '@' + item;
                        }    
                    },
                    toolbar: [
                        ['font', ['bold', 'underline']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link']],
                        ['fm-button', ['fm']],
                    ],
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('description', contents);
                        }
                    },
                    buttons: {
                        fm: FMButton
                    }
                });

                $("#comment_box").summernote({
                    height: 100,
                    hint: {
                        mentions: users_for_mention,
                        match: /\B@(\w*)$/,
                        search: function (keyword, callback) {
                            callback($.grep(this.mentions, function (item) {
                                return item.indexOf(keyword) == 0;
                            }));
                        },
                        template : function (item) {
                            return '<img src="{{ env('APP_URL') }}/storage/' + users[users_for_mention.indexOf(item)].image + '" class="img-fluid rounded-circle" style="width: 20px; height: 20px; margin-right: 5px;"/>' + item;
                        },
                        content: function (item) {
                            item = item.replace(/\s/g, '_');
                            return '@' + item + ' ';
                        }    
                    },
                    toolbar: [
                        ['font', ['bold', 'underline']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link']],
                        ['fm-button', ['fm']],
                    ],
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('comment', contents);
                        }
                    },
                    buttons: {
                        fm: FMButton
                    }
                });
    
            document.addEventListener('comment-added', function () {
                $("#comment_box").summernote("code", "");
            });

            $('.users').select2({
                placeholder: 'Select User',
                templateResult: format,
                templateSelection: format,
                escapeMarkup: function(m) {
                    return m;
                }
            });
    
            $('.users').on('change', function(e){
                var users = $('.users');
                var selected_users = users.val();
                @this.set('user_ids', selected_users);
            });
    
            $('#project_id').select2({
                placeholder: 'Select Project',
            });
    
            $('#project_id').on('change', function(e){
                var project_id = $('#project_id').val();
                @this.set('project_id', project_id);
            });
    
            function format(state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "{{ env('APP_URL') }}/storage";
                var $state = $(
                    '<span><img class="select2-selection__choice__display_userImg" src="' + baseUrl + '/' + state.element.attributes[0].value + '" /> ' + state.text + '</span>'
                );
                return $state;
            };

            $('.add_date_btn').flatpickr({
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".add_date_btn").html(dateStr);
                    @this.set('dueDate', dateStr);
                },
            });
        }

    </script>
@endpush