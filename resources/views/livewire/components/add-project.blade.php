<div>
    <div wire:ignore class="modal fade" id="add-project-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-layer' ></i></span> <span class="project-form-text">Add Project</span></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addProject" method="POST" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Select Client<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="custom-select">
                                        <select wire:model.live="client_id" class="form-style">
                                            <option value="">Select Client</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Project Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="project_name" type="text" class="form-style" placeholder="Project Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Upload Logo</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="form-file_upload form-file_upload-logo">
                                        <input type="file" id="formFile">
                                        <div class="form-file_upload-box">
                                            <div class="form-file_upload-box-icon"><i class='bx bx-image'></i></div>
                                            <div class="form-file_upload-box-text">Upload Image</div>
                                        </div>
                                        <div class="form-file_upload-valText">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <label for="">Add Users</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="" id="" class="form-control users" multiple>
                                        @foreach ($users as $user)
                                            <option data-image="{{ $user->image }}"  value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <label for="" class="mb-2">Select Date</label>
                            <div class="row align-items-center">
                                <div class="col mb-4 mb-md-0">
                                    <a href="javascript:;" class="btn w-100 btn-sm btn-border-secondary project_start_date"><i class='bx bx-calendar-alt' ></i> Start Date</a>
                                </div>
                                <div class="col-auto text-center font-500 mb-4 mb-md-0">To</div>
                                <div class="col">
                                    <a href="javascript:;" class="btn w-100 btn-sm btn-border-danger project_due_date"><i class='bx bx-calendar-alt' ></i> Due Date</a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="mb-2">Add Description</label>
                                    <textarea wire:model="project_description" type="text" class="form-style" placeholder="Add Description" rows="4" cols="30"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary project-form-btn">Add Project</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        $(document).ready(function() {


            document.addEventListener('project-added', event => {
                $('#add-project-modal').modal('hide');
                $('.project-form-text').html('Add Project');
                $('.project-form-btn').html('Add Project');
                $('.users').val(null).trigger('change');
                $('.project_start_date').html('Start Date');
                $('.project_due_date').html('Due Date');

            });

            document.addEventListener('edit-project', event => {
                $('#add-project-modal').modal('show');
                $('.project-form-text').html('Edit Project');
                $('.project-form-btn').html('Update Project');
                if(event.detail[0].start_date){
                    $('.project_start_date').html(event.detail[0].start_date);
                }else{
                    $('.project_start_date').html('Start Date');
                }
                if(event.detail[0].due_date){
                    $('.project_due_date').html(event.detail[0].due_date);
                }else{
                    $('.project_due_date').html('Due Date');
                }
                let project_users = event.detail[0].users;
                let project_users_array = [];
                project_users.forEach(function (user) {
                    project_users_array.push(user.id);
                });

                $('.users').val(project_users_array).trigger('change');
                $(".users").select2();

            });

            $('.project_start_date').flatpickr({
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".project_start_date").html(dateStr);
                    @this.set('project_start_date', dateStr);
                },
            });

            $('.project_due_date').flatpickr({
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".project_due_date").html(dateStr);
                    @this.set('project_due_date', dateStr);
                },
            });

            $('.users').select2({
                placeholder: "Select Users",
                allowClear: true,
                templateResult: format,
                templateSelection: format,
            });

            $('.users').on('change', function (e) {
                var data = $(this).select2("val");
                @this.set('project_users', data);
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
        });
    </script>

@endpush


