<div>
    <div wire:ignore class="modal fade" id="add-role-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-user'></i></span> <span class="role-form-text">Add Role</span></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addRole" method="POST" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Role Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="role_name" type="text" class="form-style" placeholder="Role Name">
                                </div>
                                <span class="text-danger">@error('role_name') {{ $message }} @enderror</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Permissions<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <select class="form-style permissions" multiple>
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">@error('role_name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary role-form-btn">Add Role</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    $(document).ready(function() {
        function initPlugins(){
            $('.permissions').select2({
                placeholder: 'Select Permissions',
                allowClear: true
            });
        }

        setTimeout(() => {
            initPlugins();
        }, 1500);

        $(document).on('change', '.permissions', function(){
            @this.set('selected_permissions', $(this).val());
        });
    });
</script>
@endscript