<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('user.index') }}">All Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
        </ol>
    </nav>
    <div class="row @if($user->trashed()) archived_content @endif">
        <div class="col-lg-4">
            <div class="column-box">
                <div class="user-profile">
                    <div class="user-profile-img"><img src="/storage/images/user_pro.jpg" alt=""></div>
                    <h3 class="main-body-header-title mb-2">{{ $user->name }}</h3>
                    <div><i class="bx bx-envelope me-1 text-secondary"></i> {{$user->email}}</div>
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="row align-items-center justify-content-center gap-2">
                                <div class="col-auto px-0">
                                    <ul class="social-icons justify-content-center my-2">
                                        <li><a href="#"><i class='bx bxl-facebook'></i></a></li>
                                        <li><a href="#"><i class='bx bxl-linkedin' ></i></a></li>
                                        <li><a href="#"><i class='bx bxl-instagram' ></i></a></li>
                                        <li><a href="#"><i class='bx bxl-github' ></i></a></li>
                                        <li><a href="#"><i class='bx bxl-twitter' ></i></a></li>
                                    </ul> 
                                </div>
                                <div class="col-auto">
                                    <div class="card_style-user-head-position"><i class="bx bx-briefcase text-primary"></i> {{ $user->designation ?? 'Not Added' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-cake text-warning'></i></span> Date Of Birth</div>
                    <div class="col dob">
                        <i class='bx bx-calendar'></i>
                        @if($user->details->dob) {{  $user->details->dob }} @else Not Added  @endif
                    </div>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar-alt text-success' ></i></span> Joining Date</div>
                    <div class="col">{{ \Carbon\Carbon::parse($user->created_at)->format('d M,Y') }}</div>
                </div>
                <hr>
                <div>
                    <div class="title-label"><i class='bx bx-sitemap text-primary' ></i> Assign Teams</div>
                    <div class="btn-list">
                        @foreach($user->teams as $team)
                            <a href="javascript:" class="btn-batch">{{ $team->name ?? 'Not Added' }}</a>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div>
                    <div class="title-label"><i class='bx bx-briefcase text-primary' ></i> Assign Clients</div>
                    <div class="btn-list">
                        @foreach($user_clients as $client)
                            <a wire:navigate href="{{ route('client.profile',$client->id) }}" class="btn-batch">{{ $client->name }}</a>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div>
                    <div class="title-label"><i class='bx bx-briefcase text-primary' ></i> Projects</div>
                    <div class="btn-list">
                        @foreach($user_projects as $project)
                            <a wire:navigate href="{{ route('project.profile',$project->id) }}" class="btn-batch">{{ $project->name }}</a>
                        @endforeach
                    </div>
                </div>                             
            </div>
        </div>
        <div class="col-lg-8">
            <div class="column-box mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="column-title mb-0"><i class="bx bx-line-chart text-primary"></i> Overview</h3>
                    </div>
                    <div class="col">
                        <div class="main-body-header-right">
                            <!-- Edit -->
                            @can('Edit User')
                            <div class="cus_dropdown">
                                <!-- For Active Class = btn-border-success | For Archived Class = btn-border-archived -->

                                @if(!$user->trashed())
                                <div class="cus_dropdown-icon btn-border btn-border-success">Active <i class='bx bx-chevron-down' ></i></div>
                                @else
                                <div class="cus_dropdown-icon btn-border btn-border-archived">Archived <i class='bx bx-chevron-down'></i></div>
                                @endif


                                <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                    <div class="cus_dropdown-body-wrap">
                                        <ul class="cus_dropdown-list">
                                            <li><a href="javascript:;" wire:click="changeUserStatus('active')" @if(!$user->trashed()) class="active" @endif> Active</a></li>
                                            <li><a href="javascript:;" wire:click="changeUserStatus('archived')" @if($user->trashed()) class="active" @endif> Archived</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:" wire:click="emitEditUserEvent({{ $user->id }})" class="btn-sm btn-border btn-border-secondary"><i class='bx bx-pencil'></i> Edit</a>
                            @endcan
                            @can('Delete User')
                            <a href="#" class="btn-sm btn-border btn-border-danger" wire:click="forceDeleteUser({{$user->id}})" wire:confirm="Are you sure you want to delete?"><i class='bx bx-trash'></i> Delete</a>
                            {{-- <a href="javascript:" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a> --}}
                            @endcan
                        </div>
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="column-box states_style-progress">
                        <div class="row">
                            <div class="col">
                                <h5 class="title-md mb-1">{{ $user->projects->where('status','completed')->count() }}</h5>
                                <div class="states_style-text">Projects Done</div>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-icon"><i class='bx bx-objects-horizontal-left' ></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="column-box states_style-success">
                        <div class="row">
                            <div class="col">
                                <h5 class="title-md mb-1">{{ $user->tasks->where('status', 'completed')->count() }}</h5>
                                <div class="states_style-text">Tasks Done</div>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-icon"><i class='bx bx-task' ></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="column-box states_style-danger">
                        <div class="row">
                            <div class="col">
                                <h5 class="title-md mb-1">{{ $user->tasks->where('due_date', '<', now())->where('status', '!=', 'completed')->count() }}
                                </h5>
                                <div class="states_style-text">Tasks Overdue</div>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-icon"><i class='bx bx-task-x' ></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column-box mb-4" wire:ignore>
                <h5 class="title-sm mb-2">Bio <i class='bx bx-pencil edit-bio' ></i> </h5>
                <div class="user-profile-bio">
                    {!! $user->details->bio ?? 'Not Added' !!}
                </div>      
                <button class="btn btn-primary btn-sm mt-4 update-bio-btn d-none" wire:click="updateBio">Update</button>
            </div>
            <div class="column-box mb-4" wire:ignore>
                <h5 class="title-sm mb-2">Skils <i class='bx bx-plus add-skills' ></i></h5>
                <div class="btn-list skills-list">
                    @if($user->details->skills)
                        @foreach(json_decode($user->details->skills) as $skill)
                            <span class="btn-batch">{{ $skill }}</span>
                        @endforeach
                    @else
                        <span>Not Added</span>
                    @endif
                </div>
                @php
                    $skills = $user->details->skills ?? '[]';
                    // convert to array
                    $skills = json_decode($skills);
                    $skills = implode(',', $skills);
                    // dd($skills);
                @endphp
                <div class="skills-input d-none">
                    <input name='skills' value='{{ $skills }}' autofocus >
                    <button class="btn btn-primary " wire:click="updateSkills">Save</button>
                </div>
            </div>
        </div>
    </div>
    <livewire:components.add-user @saved="$refresh" />
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endassets


@script
<script>
    $(document).ready(function(){

        // bio
        $('.edit-bio').click(function(){
            $(".update-bio-btn").removeClass('d-none');
            $('.user-profile-bio').summernote({
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
                        @this.set('bio', contents);
                    }
                }
            });
        });
        $('.update-bio-btn').click(function(){
            $('.user-profile-bio').summernote('destroy');
            $(".update-bio-btn").addClass('d-none');
        });

        // skills
        var input = document.querySelector('input[name=skills]');
        new Tagify(input)

        input.addEventListener('change', function(e){
            let skillsArray = e.target.value;

            skillsArray = JSON.parse(skillsArray);
            skillsArray = skillsArray.map(function(item){
                return item.value;
            });

            skills = JSON.stringify(skillsArray);

            @this.set('skills', skills);
        });

        $('.add-skills').click(function(){
            $('.skills-input').removeClass('d-none');
            $(".skills-list").addClass('d-none');
            $('.skills-input input').focus();
        });

        $('.skills-input button').click(function(){
            $(".skills-list").removeClass('d-none');
            $('.skills-input').addClass('d-none');
            let skills = $('.skills-input input').val();
            skills = JSON.parse(skills);
            let html = '';
            skills.forEach(function(skill){
                html += '<span class="btn-batch">'+skill.value+'</span>';
            });
            $('.skills-list').html(html);
        });

        // DOB

        $(".dob").flatpickr({
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                @this.updateDob(dateStr);
                $(".dob").html(dateStr);
            }
        });


        
    });
</script>
@endscript
