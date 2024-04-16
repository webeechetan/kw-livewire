<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Webeesocial</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Tasks</li>
        </ol>
    </nav>

    <div class="dashboard-head pb-0 mb-3">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Tasks</h3>
                <span class="text-light">|</span>
                <a data-bs-toggle="modal" data-bs-target="#add-client-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary toggleForm"><i class="bx bx-plus"></i> Add Task</a>
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Company">
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
                                            <li class="filterSort_item">
                                                <a wire:navigate href="#" class="btn-batch" >Newest</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="#" class="btn-batch"><i class='bx bx-down-arrow-alt' ></i> A To Z</a>
                                            </li>
                                            <li class="filterSort_item">
                                                <a wire:navigate href="#" class="btn-batch"><i class='bx bx-up-arrow-alt' ></i> Z To A</a>
                                            </li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a href="#" class="btn-batch">All</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="#" class="btn-batch">Active</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="#" class="btn-batch">Completed</a></li>
                                            <li class="filterSort_item"><a wire:navigate href="#" class="btn-batch">Archive</a></li>
                                        </ul>
                                        <hr>
                                        <h5 class="filterSort-header"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By Projects</h5>
                                        <ul class="filterSort_btn_group list-none">
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Active</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Completed</a></li>
                                            <li class="filterSort_item"><a href="#" class="btn-batch">Archive</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-0">
        <div class="tabNavigationBar-tab border_style">
            <a href="{{ route('task.list-view') }}" class="tabNavigationBar-item @if(request()->routeIs('task.list-view')) active @endif" wire:navigate ><i class='bx bx-list-ul'></i> List</a>
            <a href="{{ route('task.index') }}" class="tabNavigationBar-item @if(request()->routeIs('task.index')) active @endif" wire:navigate><i class='bx bx-columns' ></i> Board</a>
        </div>
    </div>
    <!-- Kanban -->
    <div class="kanban_bord">
        <div class="kanban_bord_scrollbar scrollbar">
            <div class="kanban_bord_body_columns" wire:sortable-group="updateTaskOrder">
                @php
                    $groups = ['pending','in_progress','in_review','completed'];
                @endphp
                @foreach($groups as $group)
                    @php
                        $board_class = '';
                        if($group=='pending'){
                            $board_class = 'kanban_bord_column_assigned';
                        }
                        if($group=='in_progress'){
                            $board_class = 'kanban_bord_column_accepted';
                        }
                        if($group=='in_review'){
                            $board_class = 'kanban_bord_column_in_review';
                        }
                        if($group=='completed'){
                            $board_class = 'kanban_bord_column_completed';
                        }
                    @endphp
                    <div class="kanban_bord_column {{ $board_class }}" wire:key="group-{{$group}}"  wire:sortable.item="{{ $group  }}">
                        <div class="kanban_bord_column_title_wrap">
                            <div class="kanban_bord_column_title" wire:sortable.handle>
                                @if($group == 'pending')
                                    Assigned
                                @elseif($group == 'in_progress')
                                    Accepted
                                @elseif($group == 'in_review')
                                    In Review
                                @elseif($group == 'completed')
                                    Completed
                                @endif
                            </div>
                        </div>
                        <div class="kanban_column" wire:sortable-group.item-group="{{$group}}" wire:sortable-group.options="{ 
                            animation: 400 ,
                            easing: 'cubic-bezier(1, 0, 0, 1)',
                            onStart: function (evt) {
                                console.log(evt);
                                // change the color of the dragging item
                                evt.item.style.background = '#fff';
                            },
                        }">
                            @if(!count($tasks[$group]))
                            <div class="kanban_column_empty"><i class='bx bx-add-to-queue'></i></div>
                            @endif
                            @foreach($tasks[$group] as $task)
                                @php
                                    $date_class = '';
                                    if($task['due_date'] < date('Y-m-d')){
                                        $date_class = 'kanban_column_task_overdue';
                                    }
                                    if($task['due_date'] == date('Y-m-d')){
                                        $date_class = 'kanban_column_task_warning';
                                    }
                                    
                                @endphp
                                <div class="kanban_column_task {{ $date_class }} h-100" wire:key="task-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}" >
                                    <div class="kanban_column_task-wrap" wire:sortable-group.handle>
                                        <div class="cus_dropdown cus_dropdown-edit z-0">
                                            <div class="cus_dropdown-icon"><i class="bx bx-dots-horizontal-rounded"></i></div>
                                            <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                                <div class="cus_dropdown-body-wrap">
                                                    <ul class="cus_dropdown-list">
                                                        <li><a wire:navigate="" href="http://127.0.0.1:8000/teams/edit/1"><span class="text-secondary"><i class="bx bx-pencil"></i></span> Edit</a></li>
                                                        <li><a href="#"><span class="text-danger"><i class="bx bx-trash"></i></span> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kanban_column_task_name">
                                            <div class="kanban_column_task_complete_icon d-none">
                                                <i class='bx bx-check' ></i>
                                            </div>
                                            <div class="kanban_column_task_name_text">
                                                <h4 wire:click="enableEditForm({{$task['id']}})" class="fs-6">{{ $task['name'] }}</h4>
                                                <div class="kanban_column_task_project_name">
                                                    <span class="text-black">
                                                        @if($task['project'])
                                                        <i class='bx bx-file-blank' ></i>  {{ $task['project']['name'] }} 
                                                        @endif
                                                    </span>
                                                    <span class="text-black">
                                                        @if(count($task['comments']) > 0)
                                                        <i class='bx bx-chat' ></i>  {{ count($task['comments'])  }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="kanban_column_task_bot mt-0 pt-0 border-top-0">
                                            <div class="kanban_column_task_actions">
                                                <a href="#" class="kanban_column_task_date task">
                                                    <span class="btn-icon-task-action"><i class='bx bx-calendar-alt' ></i></span>
                                                    <span class="">{{ $task['due_date'] }}</span>
                                                </a>
                                            </div>
                                            <div>
                                                <!-- avatar group -->
                                                <div class="avatarGroup avatarGroup-overlap">
                                                    @foreach($task['users'] as $user)
                                                    <a href="javascript:;" class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Aadil Prasad Brahmbhatt">AP</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    {{-- Add task canvas --}}
    @if($view_form)
    <div class="AddCanvas ">
        <!-- Add Task Canvas Header -->
        <div class="AddTask_head">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="AddTask_title-wrap">
                        <label class="AddTask_title-lable"><span class="AddTask_title-icon"><i class='bx bx-notepad'></i></span> Task Title</label>
                        <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Type your task here...">
                    </div>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-5">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="javascript:;" wire:click="store" class="btn-border btn-border-sm btn-border-success"><i class='bx bx-check'></i> Save</a>
                        <a href="{{ route('task.index') }}" wire:navigate  class="btn-border btn-border-sm btn-border-primary close-add-task-form"><i class='bx bx-x' ></i> Close</a>
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
                                    <option value="" disabled selected>Select Project</option>
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
                <div class="col-md-7">
                    <div class="AddTask_title-wrap">
                        <label class="AddTask_title-lable"><span class="AddTask_title-icon"><i class='bx bx-notepad'></i></span> Task Title</label>
                        <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Type your task here...">
                    </div>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-5">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="#" wire:click="updateTask" class="btn-border btn-border-sm btn-border-success"><i class='bx bx-check'></i> Update</a>
                        <a href="{{ route('task.index') }}" wire:navigate class="btn-border btn-border-sm btn-border-primary"><i class='bx bx-x' ></i> Close</a>
                        <a href="{{ route('task.index') }}" wire:navigate class="btn-border btn-border-sm btn-border-danger"><i class='bx bx-trash' ></i> Delete</a>
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
                                            <span class="req_calender_opt" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"><i class='bx bx-repeat'></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
    
                        <!-- Description -->
                        <div class="AddTask_rulesOverview_item mb-5" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Description</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <textarea name="" id="editor" cols="30" rows="10">{{ $description }}</textarea>
                            </div>
                        </div>

                        <!-- Requiring Task Date  -->
                        <div class="req_calender d-none">
                            <div class="req_calender-wrap">
                                <div class="req_calender-header">
                                    <div class="req_calender-header-item">
                                        <a href="#" class="req_calender-header-item-date req_calender-header-item-date-primary">
                                            <span><i class='bx bx-calendar-alt'></i></span> Start Date
                                        </a>
                                        <Tooltip title="Due Date" arrow>
                                            <a href="" class="req_calender-header-item-date req_calender-header-item-date-secondary">
                                                <span><i class='bx bx-calendar-alt'></i></span> Due Date
                                            </a>
                                        </Tooltip>
                                    </div>
                                </div>
                                <div class="req_calender-body">
                                    <div class="req_calender-repeats">
                                        <div class="req_calender-label">Repeats</div>
                                        <div>
                                            <select class="planHoverStyle" aria-label="Weekly">
                                                <option value="1">Weekly</option>
                                                <option value="2">Monthly</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="req_calender-repeats-weekly">
                                        <h4 class="req_calender-repeats-lable">On These Days</h4>
                                        <ul class="req_calender-repeats-weekly-day_select">
                                            <li><span>S</span></li>
                                            <li class="active"><span>M</span></li>
                                            <li><span>T</span></li>
                                            <li><span>W</span></li>
                                            <li><span>T</span></li>
                                            <li><span>F</span></li>
                                            <li><span>S</span></li>
                                        </ul>
                                    </div>

                                    <div class="req_calender-repeats-monthly">
                                        <div class="req_calender-repeats-monthly">
                                            <div class="req_calender-repeats-monthly-item">
                                                <div>
                                                    <a class="req_calender-repeats-monthly-opt active">
                                                        <span><i class='bx bx-checkbox-checked' ></i></span> On The
                                                    </a>
                                                </div>
                                                <div>
                                                    <div class="req_calender-repeats-monthly-onThe-r">
                                                        <select class="planHoverStyle" aria-label="Monthly">
                                                            <option value="1">1st</option>
                                                            <option value="2">2nd</option>
                                                            <option value="3">3rd</option>
                                                            <option value="4">4th</option>
                                                            <option value="5">Last</option>
                                                        </select>
                                                        <select class="planHoverStyle" aria-label="Monthly">
                                                            <option value="1">Sunday</option>
                                                            <option value="2">Monday</option>
                                                            <option value="3">Tuesday</option>
                                                            <option value="4">Wednesday</option>
                                                            <option value="5">Thursday</option>
                                                            <option value="5">Firday</option>
                                                            <option value="5">Suterday</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="req_calender-repeats-monthly-item mt-4">
                                                <div>
                                                    <a class="req_calender-repeats-monthly-opt">
                                                        <span><i class='bx bx-checkbox' ></i></span> On Day
                                                    </a>
                                                </div>
                                                <div>
                                                    <select class="planHoverStyle" aria-label="Monthly">
                                                        <option value="1">1st</option>
                                                        <option value="2">2nd</option>
                                                        <option value="3">3rd</option>
                                                        <option value="4">4th</option>
                                                        <option value="5">Last</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="req_calender-repeats-info">Every Monday of the week</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Activity -->
                {{-- comments --}}

                <h5 class="cmnt_act_title fs-5"><i class='bx bx-line-chart text-primary'></i> Activity</h5>
                <div class="cmnt_act">
                    @foreach( $comments as $comment)
                    <div class="cmnt_act_row">
                        <div class="cmnt_act_user">
                            <div class="cmnt_act_user_img">
                                <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/{{ $comment->user->image }}">
                            </div>
                            <div class="cmnt_act_user_name-wrap">
                                <div class="cmnt_act_user_name">{{ $comment->user->name }}</div>
                                <div class="cmnt_act_date">{{ $comment->created_at->diffForHumans() }}</div>
                                <div class="cmnt_act_user_text">{!! $comment->comment !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="custComment">
                    <div class="custComment-wrap">
                        <div class="custComment-editor" wire:ignore>
                            <textarea name="" id="comment_box" class="from-control" cols="30" rows="5"></textarea>
                        </div>
                        <button wire:click="saveComment" class="btn-border btn-border-sm btn-border-primary"><i class='bx bx-send'></i> Comment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
    <script>
        // $(document).ready(function(){
        //     $(".add-task-form").hide();
        // });
        // check if users_for_mention is already declared
        
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
                            return '<span class="mention_user" data-id=" ' + users[users_for_mention.indexOf(item)].id + ' "><img src="{{ env('APP_URL') }}/storage/' + users[users_for_mention.indexOf(item)].image + '" class="img-fluid rounded-circle" style="width: 20px; height: 20px; margin-right: 5px;"/>' + item + '</span>';
                        },
                        content: function (item) {
                            item = item.replace(/\s/g, '_');
                            let span = document.createElement('a');
                            $(span).addClass('mention_user');
                            $(span).text(' '+'@' + item + ' ');
                            return span;
                        },    
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
                            let span = document.createElement('a');
                            $(span).addClass('mention_user');
                            $(span).text(' '+'@' + item + ' ');
                            return span;
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
