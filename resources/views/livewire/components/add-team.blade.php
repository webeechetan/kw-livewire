<div wire:ignore class="modal fade" id="add-team-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-user' ></i></span> <span class="modal-text">Add Team</span></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="addTeam" method="POST" enctype="multipart/form-data">
                    <div class="modal-form-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="">Team Name<sup class="text-primary">*</sup></label>
                            </div>
                            <div class="col-md-8 mb-4">
                                <input wire:model="name" type="text" class="form-style" placeholder="Team Name Here..." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="">Upload Logo</label>
                            </div>
                            <div class="col-md-8 mb-4">
                                <div class="form-file_upload form-file_upload-logo">
                                    <input class="image_upload_input" type="file" id="formFile" wire:model="image" accept="image/jpeg, image/jpg, image/png, image/gif">
                                    <div class="form-file_upload-box">
                                        <div class="form-file_upload-box-icon"><i class='bx bx-image'></i></div>
                                        <div class="form-file_upload-box-text">Upload Image</div>
                                    </div>
                                    <div class="form-file_upload-valText">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                </div>
                                <div class="image-preview-section d-none">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="">Add Users</label>
                            </div>
                            <div class="col-md-8 mb-4">
                                <select class="form-style team_users" multiple>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-md-4 mb-4 mb-lg-0">
                                <label for="">Assign Manager</label>
                            </div>
                            <div class="col-md-8">
                                <select wire:model="team_manager" id="" class="form-style team_manager">
                                    <option value="">Select Manager</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-form-btm">
                        <div class="row">
                            <div class="col-md-6 ms-auto text-end">
                                <button type="submit" class="btn btn-primary modal-btn">Add Team</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        document.addEventListener('team-added', event => {
            $("#add-team-modal").modal('hide');
            $('.image-preview-section').addClass('d-none');
        });

        document.addEventListener('team-updated', event => {
            $("#add-team-modal").modal('hide');
        });

       

        $(".team_users").select2({
            placeholder:'Select Users'
        });

        $('.team_users').on('change', function (e) {
            var data = $(this).select2("val");
            @this.set('team_users', data);
            console.log(data);
        });

        document.addEventListener('editTeamEvent', event => {
            $("#add-team-modal").modal('show');
            let team_users = event.detail[0].users;
            let team_users_array = [];
            team_users.forEach(function (user) {
                team_users_array.push(user.id);
            });

            $('.team_users').val(team_users_array).trigger('change');

            $(".modal-btn").html('Update Team');
            $(".modal-text").html('Edit Team');


            if (event.detail[0].image) {
                $(".image-preview-section").removeClass('d-none');
                $('.image-preview-section').html('<img src="{{ asset('storage') }}/'+event.detail[0].image+'" alt="project image" class="img-fluid">');
                }

        });

        
    </script>
@endscript