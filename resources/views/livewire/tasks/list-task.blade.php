<div class="container">
    <!-- Dashboard Header -->
    <div class="main-body-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="main-body-header-title mb-0">All Tasks</h3>
                <div class="tabNavigationBar-tab">
                    <a class="tabNavigationBar-item" wire:navigate href="{{ route('task.list-view') }}"><i class='bx bx-list-ul' ></i> List</a>
                    <a class="tabNavigationBar-item tabNavigationBar-item-active" href="#"><i class='bx bx-columns' ></i> Board</a>
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
    <!-- Kanban -->
    <div class="kanban_bord">
        <div class="kanban_bord_scrollbar">
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
                                        <div class="card-options d-none">
                                            <i class='bx bx-dots-horizontal-rounded' ></i>
                                        </div>
                                        <div class="kanban_column_task_name">
                                            <div class="kanban_column_task_complete_icon d-none">
                                                <i class='bx bx-check' ></i>
                                            </div>
                                            <div class="kanban_column_task_name_text">
                                                <div wire:click="enableEditForm({{$task['id']}})">{{ $task['name'] }}</div>
                                                <div class="kanban_column_task_project_name">
                                                    <span>
                                                        @if($task['project'])
                                                        <i class='bx bx-file-blank' ></i>  {{ $task['project']['name'] }} 
                                                        @endif
                                                    </span>
                                                    <span>
                                                        @if(count($task['comments']) > 0)
                                                        <i class='bx bx-chat' ></i>  {{ count($task['comments'])  }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kanban_column_task_bot">
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
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    {{-- Add task canvas --}}
    @if($view_form)
    <div class="AddCanvas">
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
                        <a href="javascript:;" wire:click="toggleForm" class="btn-border btn-border-sm btn-border-primary"><i class='bx bx-x' ></i> Close</a>
                        <a href="{{ route('task.index') }}" wire:navigate class="btn-border btn-border-sm btn-border-danger"><i class='bx bx-trash' ></i> Delete</a>
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

                <!-- Activity -->
                {{-- comments --}}

                <h5 class="cmnt_act_title"><i class='bx bx-line-chart text-primary'></i> Activity</h5>
                <div class="cmnt_act">
                    @foreach( $comments as $comment)
                    <div class="cmnt_act_row">
                        <div class="cmnt_act_user">
                            <div class="cmnt_act_user_img">
                                <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/{{ $user->image }}">
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
                
                <div class="AddTask_body_overview">
                    <div class="AddTask_rulesOverview">
                        <div class="AddTask_rulesOverview_item" wire:ignore>
                            <div class="AddTask_rulesOverview_item_name">Comment</div>
                            <div class="AddTask_rulesOverview_item_rulesAction">
                                <textarea name="" id="comment_box" cols="30" rows="5"></textarea>
                            </div>
                            <div class="AddTask_rulesOverview_item_name mt-3"></div>
                            <div class="AddTask_rulesOverview_item_rulesAction mt-3">
                                <button wire:click="saveComment" class="btn btn-primary btn-sm"><i class="bx bx-comment"></i></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
    <script>

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
                            return '@' + item;
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
