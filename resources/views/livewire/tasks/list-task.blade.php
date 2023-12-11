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
                        <a href="javascript:;" class="btn-border btn-border-primary toggleForm"><i class='bx bx-plus'></i> Add Task</a>
                        <a class="btn-border" href="#"><i class='bx bx-filter' ></i> Filter</a>
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
                            <div class="kanban_bord_column_title" wire:sortable.handle>{{ ucfirst(str_replace('_','-',$group)) }}</div>
                        </div>
                        <div class="kanban_column" wire:sortable-group.item-group="{{$group}}" wire:sortable-group.options="{ animation: 400 }">
                            @foreach($tasks[$group] as $task)
                                <div class="kanban_column_task kanban_column_task_overdue h-100" wire:key="task-{{$task['id']}}" wire:sortable-group.item="{{ $task['id'] }}">
                                    <div class="kanban_column_task-wrap" wire:sortable-group.handle>
                                        <div class="card-options">
                                            <i class='bx bx-dots-horizontal-rounded' ></i>
                                        </div>
                                        <div class="kanban_column_task_name">
                                            <div class="kanban_column_task_complete_icon">
                                                <i class='bx bx-check' ></i>
                                            </div>
                                            <div class="kanban_column_task_name_text">
                                                <div wire:click="enableEditForm({{$task['id']}})">{{ $task['name'] }}</div>
                                                <div class="kanban_column_task_project_name"><i class='bx bx-file-blank' ></i>  Acma Web</div>
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
                        <a href="{{ route('task.index') }}" wire:navigate class="btn-border"><i class='bx bx-x' ></i> Close</a>
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

        $(".toggleForm").click(function(){
            @this.toggleForm();
        });

        function initPlugins(){
            ClassicEditor
                .create( document.querySelector( '#editor' ),{
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            '|',
                            'italic',
                            '|',
                            'link',
                            '|',
                            'bulletedList',
                            '|',
                            'numberedList',
                            '|',
                        ]
                    },
                } )
                .then( editor => {
                        editor.model.document.on( 'change:data', () => {
                            console.log( 'The Document has changed!' );
                                @this.set('description', editor.getData());
                        } )
                } )
                .catch( error => {
                        console.error( error );
                } );

                ClassicEditor
                .create( document.querySelector( '#comment_box' ),{
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            '|',
                            'italic',
                            '|',
                            'link',
                            '|',
                            'bulletedList',
                            '|',
                            'numberedList',
                            '|',
                        ]
                    },
                } )
                .then( editor => {
                        editor.model.document.on( 'change:data', () => {
                            console.log( 'The Document has changed!' );
                                @this.set('comment', editor.getData());
                        } ),
                        editor.ui.view.editable.element.addEventListener('keydown', (event) => {
                            // check for enter key without shift key press
                            if (event.keyCode == 13 && !event.shiftKey) {
                                event.preventDefault();
                                @this.saveComment();
                                setTimeout(function(){
                                    editor.setData('');
                                }, 100);
                            }
                        });
                } )
                .catch( error => {
                        console.error( error );
                } );
    
            document.addEventListener('comment-added', function () {
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
                    '<span><img height="25px" width="25px" src="' + baseUrl + '/' + state.element.attributes[0].value + '" class="img-thumbnail" /> ' + state.text + '</span>'
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
