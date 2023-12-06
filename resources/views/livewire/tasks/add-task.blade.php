<div class="AddCanvas">
    <!-- Add Task Canvas Header -->
    <div class="AddTask_head">
        <div class="row">
            <div class="col-12">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="#" wire:click="store" class="btn-border btn-border-primary"><i class='bx bx-check'></i></a>
                    <a href="#" class="btn-border"><i class='bx bx-x' ></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Task Canvas Body -->
    <div class="AddTask_body">
        <div class="AddTask_body_overview">
            <form  method="POST">
                <input class="form-control form-control-typeStyle AddTask_title" wire:model="name" type="text" placeholder="Type your task here...">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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

                    <div class="AddTask_rulesOverview_item">
                        <div class="AddTask_rulesOverview_item_name">Project</div>
                        <div class="AddTask_rulesOverview_item_rulesAction">
                            <select wire:model="project_id" id="" class="form-control">
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

@push('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                
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

        $('.users').select2({
            templateResult: format,
            templateSelection: format,
            escapeMarkup: function(m) {
                return m;
            }
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

        $('.users').on('change', function(e){
            var users = $('.users');
            var selected_users = users.val();
            @this.set('user_ids', selected_users);
        });

        $('.add_date_btn').flatpickr({
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                $(".add_date_btn").html(dateStr);
                @this.set('dueDate', dateStr);
            },
        });
    </script>
@endpush



