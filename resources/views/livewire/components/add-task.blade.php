<div>
    <div wire:ignore class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <div class="btn-list">
                <button type="button" class="btn-batch btn-batch-secondary">Accepted</button>
                <button type="button" class="btn-batch btn-batch-success">Completed</button>
            </div>
            <div class="offcanvas-header-end">
                <button type="button" class="btn-icon"><i class='bx bx-check text-success' ></i></button>
                <button type="button" class="btn-icon" data-bs-toggle="modal" data-bs-target="#attached-file-modal"><i class='bx bx-paperclip' style="transform: rotate(60deg);"></i></button>
                <button type="button" class="btn-icon"><i class='bx bx-link' ></i></button>
                <button type="button" class="btn-icon"><i class='bx bx-fullscreen'></i></button>
                <button type="button" class="btn-icon"><i class='bx bx-trash'></i></button>
                <button type="button" class="btn-icon" data-bs-dismiss="offcanvas" aria-label="Close"><i class='bx bx-arrow-to-right'></i></button>
            </div>
        </div>
        <div class="offcanvas-body scrollbar">
            <form class="taskPane" method="POST" wire:submit="saveTask">
                <div class="taskPane-head">
                    <div class="taskPane-heading">
                        <div class="taskPane-heading-label"><i class='bx bx-notepad text-primary'></i> Task Heading</div>
                        <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Write a task name">
                        {{ $name }}
                    </div>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="taskPane-body">
                    <div class="taskPane-item d-flex flex-wrap" >
                        <div class="taskPane-item-left"><div class="taskPane-item-label">Assigned to</div></div>
                        <div class="taskPane-item-right" wire:ignore>
                            <select name="" id="" class="task-users" multiple>
                                <option value="" disabled>Select User</option>
                                @foreach ($users as $user)
                                    <option data-image="{{ $user->image }}"  value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <div class="taskPane-item d-flex flex-wrap">
                        <div class="taskPane-item-left"><div class="taskPane-item-label">Notify to</div></div>
                        <div class="taskPane-item-right">
                            <select name="" id="" class="task-notify-users" multiple>
                                <option value="" disabled>Select User</option>
                                @foreach ($users as $user)
                                    <option data-image="{{ $user->image }}"  value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <div class="taskPane-item d-flex flex-wrap">
                        <div class="taskPane-item-left"><div class="taskPane-item-label">Project</div></div>
                        <div class="taskPane-item-right">
                            <select name="" id="" class="task-projects">
                                <option value="" disabled>Select Project</option>
                                @foreach ($projects as $p)
                                    @if($project->id == $p->id)
                                        <option value="{{ $p->id }}" selected>{{ $p->name }}</option>
                                    @else
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="taskPane-item d-flex flex-wrap">
                        <div class="taskPane-item-left"><div class="taskPane-item-label">Due Date</div></div>
                        <div class="taskPane-item-right">
                            <a href="javascript:">
                                <div class="icon_rounded"><i class='bx bx-calendar' ></i></div>
                                <span class="btn_link task-due-date">No Due Date</span>
                            </a>
                        </div>
                    </div>
                    <div class="taskPane-item">
                        <div class="taskPane-item-label mb-3">Description</div>
                        <div>
                            <textarea wire:model="description" id="editor" cols="30" rows="4" placeholder="Type Description"></textarea>
                        </div>
                    </div>
                    <div class="taskPane-item mb-2">
                        <div class="taskPane-item-label mb-3"><a href="#"><i class="bx bx-paperclip text-secondary" style="transform: rotate(60deg);"></i></a> 04 Attachements</div>
                        <div class="attached_files">
                            <div class="attached_files-item">
                                <div class="attached_files-item-preview">
                                    <img class="attached_files-item-thumb" src="{{ env('APP_URL') }}/storage/images/invite_banner.jpg" alt="">
                                </div>
                            </div>
                            <div class="attached_files-item">
                                <div class="attached_files-item-preview">
                                    <img class="attached_files-item-thumb" src="{{ env('APP_URL') }}/storage/images/thankyou.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="cmnt_sec">
                <!-- Activity -->
                <h5 class="cmnt_item_title"><span><i class='bx bx-line-chart text-primary'></i> Activity</span><span class="text-sm"><i class='bx bx-comment-dots text-secondary'></i> 15 Comments</span></h5>
                <div class="cmnt_item">
                    <div class="cmnt_item-tabs">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-internal-tab" data-bs-toggle="tab" data-bs-target="#nav-internal" type="button" role="tab" aria-controls="nav-internal" aria-selected="true">Internal Feedback <span class="text-sm ms-2"><i class='bx bx-comment-dots text-secondary'></i> 07</span></button>
                            <button class="nav-link" id="nav-client-tab" data-bs-toggle="tab" data-bs-target="#nav-client" type="button" role="tab" aria-controls="nav-client" aria-selected="false">Client Feedback <span class="text-sm ms-2"><i class='bx bx-comment-dots text-secondary'></i> 08</span></button>
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
        </div>
        <div class="offcanvas-footer">
            {{-- <div class="custComment">
                <div class="custComment-wrap">
                    <div class="custComment-editor" wire:ignore>
                        <textarea name="" id="comment_box" cols="30" rows="5"></textarea>
                    </div>
                    <button wire:click="saveComment" class="custComment-btn"><i class='bx bx-send'></i> Comment</button>
                </div>
            </div> --}}
            <div class="taskPane-footer-wrap">
                <button type="button" class="btn-border btn-sm btn-border-danger"><i class='bx bx-trash' ></i> Delete Task</button>
                <button type="button" wire:click="saveTask" class="btn-border btn-sm btn-border-primary ms-auto"><i class='bx bx-check'></i> Save Task</button>
            </div>
        </div>
    </div>

    <!-- Add File Modal  -->
    {{-- <div class="modal fade" id="attached-file-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-layer' ></i></span> <span class="project-form-text">Upload File Or Link</span></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Add Link</label>
                                    <input type="text" class="form-style mt-2" placeholder="Add Link...">
                                </div>
                            </div>
                            <div class="divider-or my-3 w-100"><span></span>OR<span></span></div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Upload Image <br/>Or File</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="form-file_upload form-file_upload-logo">
                                        <input type="file" id="formFile">
                                        <div class="form-file_upload-box">
                                            <div class="form-file_upload-box-icon"><i class='bx bx-image'></i></div>
                                            <div class="form-file_upload-box-text">Upload</div>
                                        </div>
                                        <div class="form-file_upload-valText">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary project-form-btn">Uplaod</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@push('scripts')
    <script>
            // Select2
            $('.task-users').select2({
                placeholder: "Select User",
                allowClear: true,
                templateResult: format,
                templateSelection: format
            });

            $(".task-users").on('change', function (e) {
                var data = $(".task-users").val();
                @this.set('task_users', data);
            });

            $('.task-notify-users').select2({
                placeholder: "Select User",
                allowClear: true,
                templateResult: format,
                templateSelection: format
            });

            $(".task-notify-users").on('change', function (e) {
                var data = $(".task-notify-users").val();
                @this.set('task_notifiers', data);
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

            flatpickr(".task-due-date", {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $('.task-due-date').text(dateStr);
                    @this.set('due_date', dateStr);
                }
            });



            document.addEventListener('edit-task', event => {
                $('.taskPane-heading-label').html('Edit Task');
                $('.btn-border-primary').html('Update Task');
                let task_users = event.detail[0].users;
                let task_notifiers = event.detail[0].notifiers;

                let task_users_ids = [];
                let task_notifiers_ids = [];

                task_users.forEach(user => {
                    task_users_ids.push(user.id);
                });

                task_notifiers.forEach(user => {
                    task_notifiers_ids.push(user.id);
                });

                $('.task-users').val(task_users_ids).trigger('change');

                $('.task-users').select2({
                    placeholder: "Select User",
                    allowClear: true,
                    templateResult: format,
                    templateSelection: format
                });

                $('.task-notify-users').val(task_notifiers_ids).trigger('change');

                $('.task-notify-users').select2({
                    placeholder: "Select User",
                    allowClear: true,
                    templateResult: format,
                    templateSelection: format
                });

                $('.task-projects').val(event.detail[0].project_id).trigger('change');

                if(event.detail[0].due_date){
                    $('.task-due-date').text(event.detail[0].due_date);
                }else{
                    $('.task-due-date').text('No Due Date');
                }

                $('#offcanvasRight').offcanvas('show');

            })
    
    </script>
@endpush
