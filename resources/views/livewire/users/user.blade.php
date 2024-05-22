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
                                    <div class="card_style-user-head-position"><i class="bx bx-user text-primary"></i> Web Developer {{$user->designation}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row align-items-center mb-2">
                    <div class="col"><span><i class='bx bx-cake text-warning'></i></span> Date Of Birth</div>
                    <div class="col">@if($user->dob) {{  $user->dob }} @else Not Added  @endif</div>
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
                            <a href="javascript:" class="btn-batch">{{ $team->name }}</a>
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
                                            <li><a href="javascript:;" wire:click="changeUserStatus('active')" @if(!$user->trashed()) class="active" @endif><span><i class='bx bx-user-check' ></i></span> Active</a></li>
                                            <li><a href="javascript:;" wire:click="changeUserStatus('archived')" @if($user->trashed()) class="active" @endif><span><i class='bx bx-user-minus' ></i></span> Archived</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:" wire:click="emitEditUserEvent({{ $user->id }})" class="btn-sm btn-border btn-border-secondary"><i class='bx bx-pencil'></i> Edit</a>
                            @endcan
                            @can('Delete User')
                            <a href="javascript:" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a>
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
                                <h5 class="title-md mb-1">12</h5>
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
                                <h5 class="title-md mb-1">1.23k</h5>
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
                                <h5 class="title-md mb-1">12</h5>
                                <div class="states_style-text">Tasks Overdue</div>
                            </div>
                            <div class="col-auto">
                                <div class="states_style-icon"><i class='bx bx-task-x' ></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column-box mb-4">
                <h5 class="title-sm mb-2">Bio</h5>
                <div class="user-profile-bio">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>      
            </div>
            <div class="column-box mb-4">
                <h5 class="title-sm mb-2">Skils</h5>
                <div class="btn-list">
                    <span class="btn-batch">Photoshop</span><span class="btn-batch">HTML</span><span class="btn-batch">jQuery</span><span class="btn-batch">Ajax</span>
                </div>
            </div>
            <div class="column-box">
                <h5 class="title-sm mb-2">Experience</h5>
                <div class="btn-list">
                    <span>10 Years as Web Designer</span>
                </div>
            </div>
        </div>
    </div>
    <livewire:components.add-user @saved="$refresh" />
</div>
