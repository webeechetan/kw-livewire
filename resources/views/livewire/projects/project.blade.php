<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
        </ol>
    </nav>
    
    <livewire:projects.components.project-tabs :project="$project" />

    <!-- Dashboard Body -->
    <div class="row">
        <div class="col-md-4">
            <div class="column-box">
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-layer text-success' ></i></span> Created By</div>
                    <div class="col">Rakesh Roshan</div>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar-alt text-primary'></i></span> Start Date</div>
                    <div class="col">26 April 2024 <a href="javascript:" class="ms-2"><i class='bx bx-pencil text-primary'></i></a></div>                    
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar text-primary'></i></span> Due Date</div>
                    <div class="col project-due-date">
                        @if($project->due_date)
                            {{ \Carbon\Carbon::parse($project->due_date)->format('d M-Y') }} 
                        @else
                            <span class="text-danger">Not Set</span>
                        @endif

                        <a href="javascript:" class="ms-2 change-due-date" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Date">
                            <i class='bx bx-pencil text-primary'></i>
                        </a>
                    </div>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar text-success'></i></span> Duration</div>
                    <div class="col">{{ \Carbon\Carbon::parse($project->due_date)->diffInDays($project->start_date)}} Days</div>
                </div>
                <hr>
                <div class="row align-items-center mb-3">
                    <div class="col"><span><i class='bx bx-user text-primary' ></i></span> Assigness</div>
                    <div class="col">
                        <div class="assign-new-user-col d-none">
                            <select class="users" name="" id="" multiple>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option 
                                        @if($project->users->contains($user->id))
                                            @selected(true)
                                        @endif
                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="javascript:" class="btn_link btn_link-border btn_link-sm assign-new-user">Add</a>
                        <!-- Avatar Group -->
                        <div class="avatarGroup avatarGroup-lg avatarGroup-overlap">
                            @php
                                $usersCount = $project->users->count();  
                            @endphp
                            @foreach($project->users as $user)
                                @if($loop->index > 2)
                                    @break
                                @endif
                                <a href="javascript:" class="avatarGroup-avatar" wire-key="project-user-{{$user->id}}">
                                    <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                        <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle">
                                    </span>
                                </a>
                            @endforeach
                            @if($usersCount > 3)
                                <a href="javascript:" class="avatarGroup-avatar" wire-key="project-user-more">
                                    <span class="avatar avatar-sm">
                                       +{{ $usersCount - 3 }}
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col"><span><i class='bx bx-layer text-primary'></i></span> Attachements</div>
                    <div class="col">
                        <div class="d-flex align-items-center flex-wrap"><span class="text-primary d-flex"><i class='bx bx-folder me-1' ></i></span> 2 <span class="px-2">|</span> <span class="text-secondary d-flex"><i class='bx bx-file-blank me-1' ></i></span>4 <a href="javascript:" class="ms-3 btn_link btn_link-border btn_link-sm">Add</a></div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="title-label">Teams</div>
                    <div class="btn-list">
                        <a href="javascript:" class="btn-batch btn-batch-profile"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                        <a href="javascript:" class="btn-batch btn-batch-profile"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                        <a href="javascript:" class="btn-batch btn-batch-profile"><span><img alt="avatar" src="http://localhost:8000/storage/images/users/Ajay Kumar.png" class="rounded-circle"></span> Tech Team</a>
                    </div>
                </div>
                <hr>
                <div class="task_progress">
                    <div class="task_progress-head">
                        <div class="task_progress-head-title">Progress</div>
                        <div class="task_progress-head-days"><span><i class='bx bx-calendar-minus'></i></span> 
                            {{ \Carbon\Carbon::parse($project->due_date)->diffInDays($project->start_date) }} Days Left</div>
                    </div>
                    @php
                    $progress = 0;
                    if($project->tasks->count() > 0){
                        $progress = ($project->tasks->where('status', 'completed')->count() / $project->tasks->count()) * 100;
                    }

                    @endphp
                    <div class="task_progress-btm">
                        <div class="progress" role="progressbar" aria-label="Project Progress" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-success" style="width: {{$progress}}%"><span class="progress-bar-text">{{  round($progress)}}%</span></div>
                        </div>
                        <div class="task_progress-btm-date d-flex justify-content-between">
                            <div><i class='bx bx-calendar text-primary' ></i> {{ \Carbon\Carbon::parse($project->start_date)->format('d M-Y') }}</div>
                            <div class="text-success"><i class='bx bx-calendar-check ' ></i> {{ \Carbon\Carbon::parse($project->due_date)->format('d M-Y') }}</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div wire:ignore class="project-description-container">

                    <div class="title-label d-flex align-items-center">Description <a href="javascript:" class="ms-2 d-inline-flex edit-description"><i class='bx bx-pencil text-primary'></i></a></div>
                    <div class="text-sm project-description txtarea">
                        {!! $project->description !!}
                    </div>
                </div>
                {{-- <a href="javascript:" class="btn_link btn_link-primary">see more</a> --}}
            </div>
        </div>
    </div>    
</div>
@push('scripts')
    
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    flatpickr(".change-due-date", {
        dateFormat: "Y-m-d",
        defaultDate: "{{ $project->due_date }}",
        onChange: function(selectedDates, dateStr, instance) {
            $(".project-due-date").html(dateStr);
            @this.changeDueDate(dateStr);
        }
    });

    $(".edit-description").click(function(){
        $(".project-description").summernote({
            height: 200,
            toolbar: [
                ['font', ['bold', 'underline']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['fm-button', ['fm']],
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.updateDescription(contents);
                }
            },
        });
    });

    // destroy summernote when clicked outside

    $(document).on("click", function(event) {
        let l = $(event.target).closest(".project-description-container").length
        if(!l){
            $(".project-description").summernote('destroy')
        }
        
    });

    $(".users").select2({
        placeholder: "Select User",
        allowClear: true
    });
    
    $(".assign-new-user").click(function(){
        $(".assign-new-user-col").toggleClass("d-none");
        $(".users").select2({
            placeholder: "Select User",
            allowClear: true
        });
    });

    $(".users").change(function(){
        var users = $(this).val();
        console.log(users);
        @this.syncUsers(users);
    });

    // user-synced
    document.addEventListener('user-synced', event => {
        $(".users").select2({
            placeholder: "Select User",
            allowClear: true
        });
    });

    // edit-task

   

    // $(document).ready(function(){
    //     $("#comment_box").summernote({
    //         height: 100,
    //         toolbar: [
    //             ['font', ['bold', 'underline']],
    //             ['para', ['ul', 'ol']],
    //             ['insert', ['link']],
    //             ['fm-button', ['fm']],
    //         ]
    //     });
    // });
    
</script>
@endpush
