<div class="container">
    <!-- Dashboard Header -->
    <div class="row align-items-center">
        <div class="col-md-6 mb-3">
            <nav aria-label="breadcrumb">
                 <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}">All Projects</a></li>
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.profile',$task->project->id) }}">{{$task->project->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Task View</li>
                </ol>        
            </nav>
        </div>
        <div class="col-md-6 mb-3 text-end">
            <a href="#" class="btn-border btn-border-danger btn-sm"><i class='bx bx-trash'></i> Delete</a>
        </div>
    </div>
    <div class="column-box">
        <div class="taskPane-dashbaord py-2 px-4">
            <div class="taskPane-dashbaord-head">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            {{-- <div class="cus_dropdown">
                                <div class="cus_dropdown-icon btn-batch btn-batch-success"><i class='bx bx-globe' ></i> Public <span><i class='bx bx-chevron-down' ></i></span></div>
                                <div class="cus_dropdown-body cus_dropdown-body_left cus_dropdown-body-widh_s">
                                    <div class="cus_dropdown-body-wrap">
                                        <ul class="cus_dropdown-list">
                                            <li><a href="javascript:" class="active"><i class='bx bx-globe me-2' ></i> Public</a></li>
                                            <li><a href="javascript:"><i class='bx bx-lock me-2' ></i> Private</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="taskPane-dashbaord-head-right">
                            <button type="button" class="btn-icon" data-bs-toggle="modal" data-bs-target="#attached-file-modal"><i class='bx bx-paperclip' style="transform: rotate(90deg);"></i></button>
                            <button type="button" class="btn-icon"><i class='bx bx-share-alt' ></i></button>
                            <button wire:click="saveTask" type="button" class="btn-border btn-border-secondary"><i class='bx bx-check' ></i> Save Task</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <form class="taskPane" method="POST" wire:submit="saveTask" enctype="multipart/form-data">
                <div class="taskPane-body">
                    <div class="row">
                        <div class="col-md-8 pe-md-5">
                            <div class="taskPane-heading mb-4">
                                <div class="taskPane-heading-label"><i class='bx bx-notepad text-primary'></i> Task Heading</div>
                                <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Write a task name">
                            </div>
                            <div class="taskPane-item d-flex flex-wrap mb-4">
                                <div class="taskPane-item-left"><div class="taskPane-item-label">Assigned to</div></div>
                                <div class="taskPane-item-right" wire:ignore>
                                    <select name="" id="" class="task-users" multiple>
                                        <option value="" disabled>Select User</option>
                                        @foreach($users as $user)
                                            <option 
                                                @if(in_array($user->id, $selectedUsers)) selected @endif
                                            value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="taskPane-item d-flex flex-wrap mb-4">
                                <div class="taskPane-item-left"><div class="taskPane-item-label">Notify to</div></div>
                                <div class="taskPane-item-right"  wire:ignore>
                                    <select name="" id="" class="task-notify-users" multiple>
                                        <option value="" disabled>Select User</option>
                                        @foreach($users as $user)
                                            <option 
                                                @if(in_array($user->id, $selectedNotifiers)) selected @endif
                                            value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="taskPane-item d-flex flex-wrap mb-4">
                                <div class="taskPane-item-left"><div class="taskPane-item-label">Project</div></div>
                                <div class="taskPane-item-right">
                                    <select wire:model="project_id" id="" class="task-projects">
                                        <option value="" disabled>Select Project</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="taskPane-item mb-4">
                                <div class="taskPane-item-label mb-3">Description</div>
                                <div wire:ignore>
                                    <textarea wire:model="description" id="editor" cols="30" rows="4" placeholder="Add Notes">{{ $description }}</textarea>
                                </div>
                            </div>
                            <div class="taskPane-item mb-4">
                                <div class="d-none">
                                    <input type="file" id="file" wire:model="attachments" multiple class="form-control">
                                </div>
                                <div class="taskPane-item-label mb-3 add-attachments"><a ><i class="bx bx-paperclip text-secondary" style="transform: rotate(60deg);"></i></a> {{$task->attachments->count()}} Attachements</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="taskPane-item d-flex flex-wrap align-items-center">
                                <div class="taskPane-item-left">
                                    <div class="taskPane-item-label"><i class='bx bx-coin-stack text-primary' ></i> Status</div>
                                </div>
                                <div class="taskPane-item-right text-end">
                                    <div class="cus_dropdown-body-wrap">
                                        <select name="" id="" wire:model="status" class="form-control">
                                            <option value="pending">Pending</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="in_review">In Review</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="taskPane-item d-flex flex-wrap mb-3">
                                <div class="taskPane-item-left">
                                    <div class="taskPane-item-label"><i class='bx bx-calendar text-secondary' ></i> Due Date</div>
                                </div>
                                <div class="taskPane-item-right text-end" wire:ignore>
                                    <a href="javascript:"><span class="btn_link due_date">{{$due_date}}</span></a>
                                </div>
                            </div>
                            <div class="taskPane-calenderView"><img src="/storage/images/date.png" class="w-100" alt=""></div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="cmnt_sec pt-4">
                <!-- Activity -->
                <div class="cmnt_item">
                    <h5 class="cmnt_item_title"><span><i class='bx bx-line-chart text-primary'></i> Comments</span><span class="text-sm"><i class='bx bx-comment-dots text-secondary'></i> 15 Comments</span></h5>
                    <div class="cmnt_item-tabs">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-internal-tab" data-bs-toggle="tab" data-bs-target="#nav-internal" type="button" role="tab" aria-controls="nav-internal" aria-selected="true">Internal Feedback <span class="text-sm btn-batch btn-batch-secondary ms-3"><i class='bx bx-comment-dots text-secondary'></i> 07 Comments</span></button>
                            <button class="nav-link" id="nav-client-tab" data-bs-toggle="tab" data-bs-target="#nav-client" type="button" role="tab" aria-controls="nav-client" aria-selected="false">Client Feedback <span class="text-sm btn-batch btn-batch-secondary ms-3"><i class='bx bx-comment-dots text-secondary'></i> 08 Comments</span></button>
                        </div>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-internal" role="tabpanel" aria-labelledby="nav-internal-tab" tabindex="0">
                            <div class="cmnt_item_row">
                                <div class="cmnt_item_user">
                                    <div class="cmnt_item_user_img">
                                        <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/images/users/Chetan%20Singh.png">
                                    </div>
                                    <div class="cmnt_item_user_name-wrap">
                                        <div class="cmnt_item_user_name">Chetan Kumar</div>
                                        <div class="cmnt_item_date">1 Week Ago</div>
                                        <div class="cmnt_item_user_text">Add logo in the client section and make it live</div>
                                    </div>
                                    <div class="cmnt_item_user-edit btn-list">
                                        <a href="#" class="btn_link"><i class='bx bx-pencil' ></i></a>
                                        <a href="#" class="btn_link"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="cmnt_item_row">
                                <div class="cmnt_item_user">
                                    <div class="cmnt_item_user_img">
                                        <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/images/users/Chetan%20Singh.png">
                                    </div>
                                    <div class="cmnt_item_user_name-wrap">
                                        <div class="cmnt_item_user_name">Chetan Kumar</div>
                                        <div class="cmnt_item_user_text text-light">Add comment here</div>
                                    </div>
                                </div>
                            </div>
                            <div class="cmnt_item_row">
                                <div class="cmnt_item_user">
                                    <div class="cmnt_item_user_img">
                                        <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/images/users/Chetan%20Singh.png">
                                    </div>
                                    <div class="cmnt_item_user_name-wrap">
                                        <div class="custComment">
                                            <div class="custComment-editor" wire:ignore>
                                                <textarea name="" id="comment_box" cols="30" rows="5"></textarea>
                                                <div class="custComment-attachments"><i class="bx bx-paperclip" style="transform: rotate(90deg);"></i></div>
                                            </div>
                                            <button wire:click="saveComment" class="btn btn-sm btn-secondary mt-3"><i class='bx bx-send'></i> Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-client" role="tabpanel" aria-labelledby="nav-client-tab" tabindex="0">
                            <div class="cmnt_item_row">
                                <div class="cmnt_item_user">
                                    <div class="cmnt_item_user_img">
                                        <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/images/users/Chetan%20Singh.png">
                                    </div>
                                    <div class="cmnt_item_user_name-wrap">
                                        <div class="cmnt_item_user_name">Chetan Kumar</div>
                                        <div class="cmnt_item_date">1 Week Ago</div>
                                        <div class="cmnt_item_user_text">Add logo in the client section and make it live</div>
                                    </div>
                                    <div class="cmnt_item_user-edit btn-list">
                                        <a href="#" class="btn_link"><i class='bx bx-pencil' ></i></a>
                                        <a href="#" class="btn_link"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="cmnt_item_row">
                                <div class="cmnt_item_user">
                                    <div class="cmnt_item_user_img">
                                        <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/images/users/Chetan%20Singh.png">
                                    </div>
                                    <div class="cmnt_item_user_name-wrap">
                                        <div class="cmnt_item_user_name">Chetan Kumar</div>
                                        <div class="cmnt_item_date">1 Week Ago</div>
                                        <div class="cmnt_item_user_text">Add logo in the client section and make it live</div>
                                    </div>
                                    <div class="cmnt_item_user-edit btn-list">
                                        <a href="#" class="btn_link"><i class='bx bx-pencil' ></i></a>
                                        <a href="#" class="btn_link"><i class='bx bx-trash' ></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="taskPane-footer-wrap pt-3 mt-4">
                <button type="button" class="btn-border btn-border-danger"><i class="bx bx-trash"></i> Delete Task</button>
                <button type="button" wire:click="saveTask" class="btn-border btn-border-secondary ms-auto"><i class='bx bx-check' ></i> Save Task</button>
            </div>
        </div>  
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#comment_box').summernote(
                {
                    toolbar: [
                        ['font', ['bold', 'underline']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link']],
                        ['fm-button', ['fm']],
                    ]
                }
            );

            $("#editor").summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('description', contents);
                        }
                }
            });

            $('.task-users').select2({
                placeholder: 'Select User',
                allowClear: true
            });

            $(".task-users").on('change', function (e) {
                var data = $(".task-users").val();
                @this.set('selectedUsers', data);
            });

            $('.task-notify-users').select2({
                placeholder: 'Select Notify User',
                allowClear: true
            });

            $(".task-notify-users").on('change', function (e) {
                var data = $(".task-notify-users").val();
                @this.set('selectedNotifiers', data);
            });

            flatpickr(".due_date", {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $('.due_date').text(dateStr);
                    @this.set('due_date', dateStr);
                    
                },
                inline: true,
                defaultDate: "{{ $due_date }}"
            });

            $(".add-attachments").on('click', function(){
                $("#file").click();
            });
        });
    </script>
@endpush
