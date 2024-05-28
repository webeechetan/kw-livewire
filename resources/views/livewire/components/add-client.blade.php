<div>
    <div wire:ignore class="modal fade" id="add-client-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h3 class="modal-title"><span class="btn-icon btn-icon-primary me-1"><i class='bx bx-user'></i></span> <span class="client-form-text">Add Client</span></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addClient" method="POST" enctype="multipart/form-data">
                        <div class="modal-form-body">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Company Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="client_name" type="text" class="form-style" placeholder="Company Name">
                                </div>
                                <span class="text-danger">@error('client_name') {{ $message }} @enderror</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Brand Name<sup class="text-primary">*</sup></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="brand_name" type="text" class="form-style" placeholder="Brand Name">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" wire:model="use_brand_name" value="1" id="use_brand_name">
                                        <label class="form-check-label" for="defaultCheck1">Use This as Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="">Point Of Contact</label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <input wire:model="point_of_contact" type="text" class="form-style" placeholder="Point Of Contact">
                                </div>
                                <span class="text-danger">@error('point_of_contact') {{ $message }} @enderror</span>
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
                            {{-- <div class="row">
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
                            </div> --}}

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
                            
                                    @if ($client_image)
                                   
                                        <div class="mt-3">
                                            <img src="{{ $client_image }}" alt="Image Preview" class="img-fluid" style="max-width: 200px;">
                                        </div>
                                    @else
                                        <div class="old-image mt-3">
                                            <img src="" alt="" class="img-fluid old-image-src">
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="mb-2">Add Description</label>
                                    <textarea type="text" wire:model="client_description" class="form-style" placeholder="Add Description" rows="4" cols="30"></textarea>
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

@assets
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endassets

@script
    <script>
        $(document).ready(function() {

            flatpickr('.client-onboard-date', {
                enableTime: true,
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".client-onboard-date").html(dateStr);
                    @this.set('client_onboard_date', dateStr);
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
                        @this.set('client_onboard_date', dateStr);
                    },
                });
                if(event.detail[0].use_brand_name == 1){
                    $('#use_brand_name').prop('checked', true);
                }else{
                    $('#use_brand_name').prop('checked', false);
                }
                $('.old-image').removeClass('d-none');
                $('.old-image-src').attr('src', '{{ env("APP_URL") }}/storage/'+event.detail[0].image);
                $('.client-form-text').html('Edit');
                $('.client-form-btn').html('Update');
            })

        });
    </script>
@endscript