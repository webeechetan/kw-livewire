<div>
    <div wire:ignore class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header taskPane-dashbaord-head py-3 px-4">
            <div class="btn-list">
                <select name="" id="" wire:model="status">
                    <option value="" disabled selected>Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In-Progress</option>
                    <option value="in_review">In-Review</option>
                    <option value="completed">Completed</option>
                </select> 
            </div> 
            <div class="taskPane-dashbaord-head-right">
                <button type="button" class="btn-icon"><i class='bx bx-check text-success' ></i></button>
                <button type="button" class="btn-icon" data-bs-toggle="modal" data-bs-target="#attached-file-modal"><i class='bx bx-paperclip' style="transform: rotate(60deg);"></i></button>
                <button type="button" class="btn-icon"><i class='bx bx-link' ></i></button>
                <button type="button" class="btn-icon" wire:click="viewFullscree"><i class='bx bx-fullscreen'></i></button>
                <button type="button" class="btn-icon"><i class='bx bx-trash'></i></button>
                <a href=""><button type="button" class="btn-icon" data-bs-dismiss="offcanvas" aria-label="Close"><i class='bx bx-arrow-to-right'></i></button></a>
            </div>
        </div>
        <div class="offcanvas-body scrollbar">
            <form class="taskPane px-4 py-3" method="POST" wire:submit="saveTask" enctype="multipart/form-data">
                <div class="taskPane-head">
                    <div class="taskPane-heading">
                        <div class="taskPane-heading-label"><i class='bx bx-notepad text-primary'></i> Task Heading</div>
                        <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Write a task name">
                        {{ $name }}
                    </div>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="taskPane-body">
                    <div class="taskPane-item d-flex flex-wrap mb-3" >
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
                    <div class="taskPane-item d-flex flex-wrap mb-3">
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
                    <div class="taskPane-item d-flex flex-wrap mb-3">
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
                    <div class="taskPane-item d-flex flex-wrap mb-3">
                        <div class="taskPane-item-left"><div class="taskPane-item-label">Due Date</div></div>
                        <div class="taskPane-item-right">
                            <a href="javascript:">
                                <div class="icon_rounded"><i class='bx bx-calendar' ></i></div>
                                <span class="btn_link task-due-date">No Due Date</span>
                            </a>
                        </div>
                    </div>
                    <div class="taskPane-item mb-3">
                        <div class="taskPane-item-label mb-2">Description</div>
                        <div>
                            <textarea wire:model="description" id="editor" cols="30" rows="4" placeholder="Type Description"></textarea>
                        </div>
                    </div>
                    <div class="taskPane-item mb-2">
                        <div class="taskPane-item-label mb-3"><a href="#"><i class="bx bx-paperclip text-secondary add-attachments" style="transform: rotate(60deg);"></i></a> <span class="task-attachment-count">0</span> Attachements</div>
                        <input class="d-none attachments" type="file" wire:model="attachments" multiple id="formFile" />
                        <div class="attached_files">
                            <div class="attached_files-item">
                                <div class="attached_files-item-preview">
                                    <img class="attached_files-item-thumb" src="{{ env('APP_URL') }}/storage/images/invite_banner.jpg" alt="" />
                                </div>
                            </div>
                            <div class="attached_files-item">
                                <div class="attached_files-item-preview">
                                    <img class="attached_files-item-thumb" src="{{ env('APP_URL') }}/storage/images/thankyou.jpg" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="cmnt_sec p-4 d-none">
                <!-- Activity -->
                <div class="cmnt_item">
                    <h5 class="cmnt_item_title"><span><i class='bx bx-line-chart text-primary'></i> Activity</span><span class="text-sm"><i class='bx bx-comment-dots text-secondary'></i> 15 Comments</span></h5>
                    <div class="cmnt_item-tabs">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-internal-tab" data-bs-toggle="tab" data-bs-target="#nav-internal" type="button" role="tab" aria-controls="nav-internal" aria-selected="true">Internal Comment <span class="text-sm ms-2"><i class='bx bx-comment-dots text-secondary'></i> 07</span></button>
                            <button class="nav-link" id="nav-client-tab" data-bs-toggle="tab" data-bs-target="#nav-client" type="button" role="tab" aria-controls="nav-client" aria-selected="false">Client Feedback <span class="text-sm ms-2"><i class='bx bx-comment-dots text-secondary'></i> 08</span></button>
                        </div>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-internal" role="tabpanel" aria-labelledby="nav-internal-tab" tabindex="0">
                            <div class="custComment">
                                <div class="custComment-wrap">
                                    <div class="custComment-editor p-0" wire:ignore>
                                        <textarea wire:model="comment" name="" id="comment_box" class="form-control mb-3" cols="30" rows="5"></textarea>
                                    </div>
                                    <button wire:click="saveComment" class="custComment-btn btn-sm btn-border-primary"><i class='bx bx-send'></i> Comment</button>
                                </div>
                            </div>
                            <div class="comment-rows mt-4">
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
            <div class="taskPane-footer-wrap py-3 px-4">
                <button type="button" wire:click="deleteTask" class="btn-border btn-sm btn-border-danger"><i class='bx bx-trash' ></i> Delete Task</button>
                <button type="button" wire:click="saveTask" class="btn-border btn-sm btn-border-primary save-task-button ms-auto"><i class='bx bx-check'></i> Save Task</button>
            </div>
        </div>
    </div>
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
                            return '<span class="mention_user" data-id=" ' + users[users_for_mention.indexOf(item)].id + ' ">' + item + '</span>';
                        },
                        content: function (item) {
                            item = item.replace(/\s/g, '_');
                            let span = document.createElement('span');
                            $(span).addClass('mention_user');
                            $(span).text(' '+'@' + item + ' ');
                            return span;
                        },    
                    },
                    toolbar: [
                        ['font', ['bold', 'underline']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link']],
                    ],
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('description', contents);
                        }
                    }
                });

                $("#comment_box").summernote({
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
                            return '<span class="mention_user" data-id=" ' + users[users_for_mention.indexOf(item)].id + ' ">' + item + '</span>';
                        },
                        content: function (item) {
                            item = item.replace(/\s/g, '_');
                            let span = document.createElement('span');
                            $(span).addClass('mention_user');
                            $(span).text(' '+'@' + item + ' ');
                            return span;
                        },    
                    },
                    toolbar: [
                        ['font', ['bold', 'underline']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link']],
                    ],
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('comment', contents);
                        }
                    }
                });
            }

            $('.add-attachments').on('click', function(){
                $('.attachments').click();
            });

            setInterval(() => {
                initPlugins();
            }, 1000);

            // Select2
            $('.task-users').select2({
                placeholder: "Select User",
                allowClear: true,
            });

            $(".task-users").on('change', function (e) {
                var data = $(".task-users").val();
                @this.set('task_users', data);
            });

            $('.task-notify-users').select2({
                placeholder: "Select User",
                allowClear: true,
            });

            $(".task-notify-users").on('change', function (e) {
                var data = $(".task-notify-users").val();
                @this.set('task_notifiers', data);
            });

            

            flatpickr(".task-due-date", {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $('.task-due-date').text(dateStr);
                    @this.set('due_date', dateStr);
                }
            });

            document.addEventListener('edit-task', event => {
                $(".cmnt_sec").removeClass('d-none');
                
                $('.taskPane-heading-label').html('Edit Task');
                $('.save-task-button').html('Update Task');
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

                // $('.task-users').select2({
                //     placeholder: "Select User",
                //     allowClear: true,
                //     templateResult: format,
                //     templateSelection: format
                // });

                $('.task-notify-users').val(task_notifiers_ids).trigger('change');

                // $('.task-notify-users').select2({
                //     placeholder: "Select User",
                //     allowClear: true,
                //     templateResult: format,
                //     templateSelection: format
                // });

                $('.task-projects').val(event.detail[0].project_id).trigger('change');

                if(event.detail[0].due_date){
                    $('.task-due-date').text(event.detail[0].due_date);
                }else{
                    $('.task-due-date').text('No Due Date');
                }
                $(".task-attachment-count").html(event.detail[0].attachments.length);
                
                // .task-attachments

                // let attachment_html = '';

                // event.detail[0].attachments.forEach(attachment => {
                //     attachment_html += `<div class="task-attachments-item">
                //         <div class="task-attachments-item-img">
                //             <a href="{{ env('APP_URL') }}/storage/${attachment.attachment_path}" target="_blank">
                //                 ${attachment.attachment_path}
                //             </a>
                //         </div>
                //     </div>`;
                // });

                // $('.task-attachments').html(attachment_html);
                console.log(event.detail[0].comments);
                event.detail[0].comments.forEach(comment => {
                    let comment_html = `<div class="cmnt_item_row">
                        <div class="cmnt_item_user">
                            <div class="cmnt_item_user_img">
                                <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/images/users/Chetan%20Singh.png">
                            </div>
                            <div class="cmnt_item_user_name-wrap">
                                <div class="cmnt_item_user_name">${comment.user.name}</div>
                                <div class="cmnt_item_date">${comment.created_at}</div>
                                <div class="cmnt_item_user_text">${comment.comment}</div>
                            </div>
                        </div>
                    </div>`;

                    $('.comment-rows').append(comment_html);
                });


                $('#offcanvasRight').offcanvas('show');

            })

            // file-attached
            document.addEventListener('file-attached', event => {
                $(".task-attachment-count").html(event.detail.length);
                $('#attached-file-modal').modal('hide');
            });

            // comment-added 

            document.addEventListener('comment-added', event => {
                console.log(event.detail);
                let comment_html = `<div class="cmnt_item_row">
                    <div class="cmnt_item_user">
                        <div class="cmnt_item_user_img">
                            <img class="rounded-circle" src="{{ env('APP_URL') }}/storage/images/users/Chetan%20Singh.png">
                        </div>
                        <div class="cmnt_item_user_name-wrap">
                            <div class="cmnt_item_user_name">${event.detail[0].user.name}</div>
                            <div class="cmnt_item_date">${event.detail[0].created_at}</div>
                            <div class="cmnt_item_user_text">${event.detail[0].comment}</div>
                        </div>
                    </div>
                </div>`;

                $('.comment-rows').append(comment_html);
                $('#comment_box').val('');
            });

    </script>
@endpush
