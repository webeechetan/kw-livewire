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
                    <div class="user-profile-img">
                        @if($user->image)
                            <img src="{{ env('APP_URL') }}/storage/{{ $user->image }}" alt="">
                        @else
                            <span class="avatar avatar-{{$user->color}}">{{ $user->initials }}</span>
                        @endif
                    </div>
                    <input class="user-image d-none" type="file" wire:model.live="user_image" accept="image/*" >
                    <h3 class="main-body-header-title mb-2">{{ $user->name }}</h3>
                    <div class="d-flex align-items-center justify-content-center mb-2"><i class="bx bx-briefcase text-primary me-1"></i> {{ $user->designation ?? 'Not Added' }}</div>
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <i class='bx bx-sitemap me-1 text-secondary'></i> 
                        @if(!$user->mainTeam)
                            Not Added
                        @else
                            {{ $user->mainTeam->name }}
                        @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-3"><i class="bx bx-envelope me-1 text-secondary"></i> {{$user->email ?? 'Not Added' }}</div>
                    <ul class="social-icons justify-content-center my-2">
                        <li><a class="add-social-link" href="javascript:" data-bs-toggle="modal" data-link="{{ $user->details?->fb }}" data-type="fb" data-bs-target="#social-links-modal"><i class='bx bxl-facebook'></i></a></li>
                        <li><a class="add-social-link" href="javascript:" data-bs-toggle="modal" data-link="{{ $user->details?->linkdin }}" data-type="linkdin" data-bs-target="#social-links-modal"><i class='bx bxl-linkedin' ></i></a></li>
                        <li><a class="add-social-link" href="javascript:" data-bs-toggle="modal" data-link="{{ $user->details?->instagram }}" data-type="instagram" data-bs-target="#social-links-modal"><i class='bx bxl-instagram' ></i></a></li>
                        <li><a class="add-social-link" href="javascript:" data-bs-toggle="modal" data-link="{{ $user->details?->github }}" data-type="github" data-bs-target="#social-links-modal"><i class='bx bxl-github' ></i></a></li>
                        <li><a class="add-social-link" href="javascript:" data-bs-toggle="modal" data-link="{{ $user->details?->twitter }}" data-type="twitter" data-bs-target="#social-links-modal"><i class='bx bxl-twitter' ></i></a></li>
                    </ul> 
                </div>
                <hr>
                <div class="row align-items-center mb-3">
                    <div class="col"><span><i class='bx bx-cake text-warning'></i></span> Date Of Birth</div>
                    <div class="col dob">
                        <i class='bx bx-calendar'></i>
                        @if($user->details?->dob) {{  $user->details->dob }} @else Not Added  @endif
                    </div>
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-calendar-alt text-success' ></i></span> Joining Date</div>
                    <div class="col">{{ \Carbon\Carbon::parse($user->created_at)->format('d M,Y') }}</div>
                </div>
                <hr>
                <div>
                    <div class="title-label"><i class='bx bx-sitemap text-primary' ></i> {{ $user->teams->count() > 1 ? 'Assigned Teams' : 'Assigned Team'}}</div>
                    <div class="btn-list">
                        @if(count($user->teams) > 0)
                            @foreach($user->teams as $team)
                                <a href="javascript:" class="btn-batch">{{ $team->name }}</a>
                            @endforeach
                        @else
                            <div class="text-light">No Team Assigned</div>
                        @endif
                    </div>
                </div>
                <hr>
                <div>
                    <div class="title-label"><i class='bx bx-briefcase-alt-2 text-primary' ></i> {{ $user_clients->count() > 1 ? 'Assigned Clients' : 'Assigned Client'}}</div>
                    <div class="btn-list">
                        @if(count($user_clients) > 0)
                            @foreach($user_clients as $client)
                                <a wire:navigate href="{{ route('client.profile',$client->id) }}" class="btn-batch">{{ $client->name }}</a>
                            @endforeach
                        @else
                            <div class="text-light">No Client Assigned</div>
                        @endif
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
                    <div class="column-box states_style-progress h-100">
                        <div class="row">
                            <div class="col">
                                <h5 class="title-md mb-1">{{ $user->projects->where('status','completed')->count() }}</h5>
                                <div class="states_style-text">
                                    @if($user->projects->where('status','completed')->count() > 0)
                                        {{ $user->projects->where('status','completed')->count() > 1 ? 'Projects Done' : 'Project Done'}}
                                    @else
                                        <div class="text-light">No Project Assigned</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-icon"><i class='bx bx-objects-horizontal-left' ></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="column-box states_style-success h-100">
                        <div class="row">
                            <div class="col">
                                <h5 class="title-md mb-1">{{ $user->tasks->where('status', 'completed')->count() }}</h5>
                                <div class="states_style-text">
                                    @if($user->tasks->where('status', 'completed')->count() > 0)
                                        {{ $user->tasks->where('status', 'completed')->count() > 1 ? 'Tasks Done' : 'Task Done'}}
                                    @else
                                        <div class="text-light">No Task Assigned</div>
                                    @endif 
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-icon"><i class='bx bx-task' ></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="column-box states_style-danger h-100">
                        <div class="row">
                            <div class="col">
                                <h5 class="title-md mb-1">{{ $user->tasks->where('due_date', '<', now())->where('status', '!=', 'completed')->count() }}
                                </h5>
                                <div class="states_style-text">
                                    @if($user->tasks->where('due_date', '<', now())->where('status', '!=', 'completed')->count() > 0)
                                        {{ $user->tasks->where('due_date', '<', now())->where('status', '!=', 'completed')->count() > 1 ? 'Tasks Overdue' : 'Task Overdue'}}
                                    @else
                                        <div class="text-light">No Task Overdue</div>
                                    @endif 
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-icon"><i class='bx bx-task-x' ></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column-box mb-4">
                <h5 class="title-sm mb-2"><i class='bx bx-objects-horizontal-left text-primary' ></i> {{ $user_projects->count() > 1 ? 'Assigned Projects' : 'Assigned Project'}}</h5>
                <hr>
                <div class="btn-list">
                    @if(count($user_projects) > 0)
                        @foreach($user_projects as $project)
                            <a wire:navigate href="{{ route('project.profile',$project->id) }}" class="btn-batch">{{ $project->name }}</a>
                        @endforeach
                    @else
                        <div class="text-light">No Project Assigned</div>
                    @endif
                </div>
            </div>
            <div class="column-box mb-4" wire:ignore>
                <h5 class="title-sm mb-2">Bio <a href="javascript:;" class="btn-link"><i class='bx bx-pencil edit-bio' ></i></a></h5>
                <hr>
                <div class="user-profile-bio">
                    {!! $user->details?->bio ?? 'Not Added' !!}
                </div>      
                <button class="btn btn-primary mt-2 update-bio-btn d-none" wire:click="updateBio">Update</button>
            </div>
            <div class="column-box mb-4" wire:ignore>
                <h5 class="title-sm mb-2">Skils <a href="javascript:;" class="btn-link"><i class='bx bx-plus add-skills' ></i></a></h5>
                <hr>
                <div class="btn-list skills-list">
                    @if($user->details?->skills)
                        @foreach(json_decode($user->details->skills) as $skill)
                            <span class="btn-batch">{{ $skill }}</span>
                        @endforeach
                    @else
                        <span class="text-light">Not Added</span>
                    @endif
                </div>
                @php
                    if($user->details?->skills == null || $user->details?->skills == '[]' || $user->details?->skills == ''){
                        $skills = '';
                    }else{
                        $skills = $user->details?->skills ?? '[]';
                        // convert to array
                        $skills = json_decode($skills);
                        $skills = implode(',', $skills);
                        // dd($skills);
                    }
                @endphp
                <div class="skills-input d-none">
                    <div><input class="form-control" name='skills' value='{{ $skills }}' autofocus ></div>
                    <button class="btn btn-primary mt-3" wire:click="updateSkills">Save</button>
                </div>
            </div>
            @if($user->id == auth()->user()->id)
            <div class="column-box mb-4">
                <h5 class="title-sm mb-2">Change Password </h5>
                <hr>
                <div>
                    <div class="btn-list">
                       <span class="text-light">Current Password</span>
                    </div>
                    <div>
                        <input class="form-control" wire:model="current_password" >
                        @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-2">
                    <div class="btn-list ">
                       <span class="text-light">New Password</span>
                    </div>
                    <div>
                        <input class="form-control" wire:model="new_password" >
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary btn-sm" wire:click="changePassword">Change Password</button>
                </div>
            </div>
            @endif
        </div>
    </div>
    <livewire:components.add-user @saved="$refresh" />
    <!-- Social Links Modal -->
    <div class="modal fade" id="social-links-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Update <span class="link-text"></span> profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">    
                <div class="modal-form-body">
                    <label for="">Add Link<sup class="text-primary">*</sup></label>
                    <input wire:model="socialLink" type="text" class="form-style mt-3" placeholder="">
                    <button type="button" class="btn btn-primary w-100 mt-3 update-social-link">Update</button>
                    <div class="print-link mt-3 d-none"></div>        
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endassets


@script
<script>

    document.addEventListener('social-link-added', event => {
        $("#social-links-modal").modal('hide');
    });

    $(document).ready(function(){

        $('.user-profile-img').click(function(){
            $('.user-image').click();
        });

        // $('.add-social-link').click(function(){
        //     let type = $(this).data('type');
        //     $('.link-text').html(type);
        //     let link = $(this).data('link');
        //     @this.socialLink = link; 
        //     if(link){
        //         let html = `<a href="${link}">${link}</a>`;
        //         $(".print-link").removeClass('d-none')
        //         $(".print-link").html(html);
        //     }
        // });

        $(document).on('click', '.add-social-link', function(){
            let type = $(this).data('type');
            $('.link-text').html(type);
            let link = $(this).data('link');
            @this.socialLink = link; 
            if(link){
                let html = `<a href="${link}" class="btn btn-border-secondary btn-sm w-100" target="_blank">Open Link</a>`;
                $(".print-link").removeClass('d-none')
                $(".print-link").html(html);
            }
        });

        $(".update-social-link").click(function(e){
            let linkType = $(".link-text").html();
            @this.updateSocialLink(linkType);
            $(".add-social-link").each(function(){
                if($(this).data('type') == linkType){
                    $(this).data('link', @this.socialLink);
                }
            });
        });

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
            if(skillsArray == ''){
                @this.set('skills', '');
                return false;
            }

            skillsArray = JSON.parse(skillsArray);

            skillsArray = skillsArray.map(function(item){
                return item.value;
            });

            skills = JSON.stringify(skillsArray);
            console.log(skills);

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
            if(skills == ''){
                $('.skills-list').html('<span class="text-light">Not Added</span>');
                return false;
            }
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
