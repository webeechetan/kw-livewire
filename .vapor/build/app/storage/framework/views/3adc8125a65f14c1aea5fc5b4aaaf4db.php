<div>
    <div wire:ignore class="modal fade" id="add-client-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-user'></i></span> <span class="client-form-text">Add Client</span></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addClient" method="POST">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Client Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="client_name" type="text" class="form-style" placeholder="Client Name Here...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Onboard Date</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="btn-list btn-list-full-2 justify-content-between gap-10">
                                        <a class="btn btn-50 btn-sm btn-border-secondary client-onboard-date"><i class='bx bx-calendar-alt' ></i> Select Date</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Upload Logo</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <div class="form-file_upload form-file_upload-logo">
                                        <input type="file" id="formFile" wire:model="client_image">
                                        <div class="form-file_upload-box">
                                            <div class="form-file_upload-box-icon"><i class='bx bx-image'></i></div>
                                            <div class="form-file_upload-box-text">Upload Image</div>
                                        </div>
                                        <div class="form-file_upload-valText">Allowed *.jpeg, *.jpg, *.png, *.gif max size of 3 Mb</div>
                                    </div>
                                    <div class="old-image d-none mt-3">
                                        <img src="" alt="" class="img-fluid old-image-src">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Project Desc</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <textarea type="text" wire:model="client_description" class="form-style" placeholder="Add Project Description Here..." rows="2" cols="30"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-form-btm">
                            <div class="row">
                                <div class="col-md-6 ms-auto text-end">
                                    <button type="submit" class="btn btn-primary client-form-btn">Add Client</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('.client-onboard-date').flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".client-onboard-date").html(dateStr);
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('client_onboard_date', dateStr);
                },
            });

            document.addEventListener('client-added', event => {
                $('#add-client-modal').modal('hide');
                $('.client-form-text').html('Add Client');
                $('.client-form-btn').html('Add Client');
                $('.old-image').addClass('d-none');
                $('.old-image-src').attr('src', '');
                $('.client-onboard-date').html('Select Date');
            })

            document.addEventListener('edit-client', event => {
                $('#add-client-modal').modal('show');
                if(event.detail[0].onboard_date){
                    $('.client-onboard-date').html(event.detail[0].onboard_date);
                }else{
                    $('.client-onboard-date').html('Select Date');
                }
                $('.client-onboard-date').flatpickr({
                    enableTime: true,
                    dateFormat: "Y-m-d",
                    defaultDate: event.detail[0].onboard_date,
                    onChange: function(selectedDates, dateStr, instance) {
                        $(".client-onboard-date").html(dateStr);
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('client_onboard_date', dateStr);
                    },
                });
                $('.old-image').removeClass('d-none');
                $('.old-image-src').attr('src', '<?php echo e(env("APP_URL")); ?>/storage/'+event.detail[0].image);
                $('.client-form-text').html('Edit Client');
                $('.client-form-btn').html('Update Client');
            })

        });
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\livewire\components\add-client.blade.php ENDPATH**/ ?>