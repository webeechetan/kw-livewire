<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a wire:navigate href="{{ route('dashboard') }}">
                <i class='bx bx-line-chart'></i> Dashboard </a>
            </li> 
            <li class="breadcrumb-item">
                <a wire:navigate href="{{ route('team.index') }}">All Team</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tech Team</li>
        </ol>
    </nav>
    <livewire:teams.components.teams-tab :team="$team" @saved="$refresh"/>
    <!--- Dashboard Body --->
    @php
        $tasks = $team->tasks;
        
        if($byClient != 'all'){
            $tasks = $tasks->where('client_id', $byClient);
        }

        if($status != 'all'){
            if($status == 'overdue'){
                $tasks = $tasks->where('due_date', '<', Carbon\Carbon::now());
            }else{
                $tasks = $tasks->where('status', $status);
            }
        }

        if($byProject != 'all'){
            $tasks = $tasks->where('project_id', $byProject);
        }

        if($byUser != 'all'){
            $tasks = \App\Models\Task::whereHas('users', function($query) use($byUser){
                $query->where('user_id', $byUser);
            }); 
            
            if($byProject != 'all'){
                $tasks = $tasks->where('project_id', $byProject);
            }
            $tasks = $tasks->get();
        }

        if($project_start_date != null && $project_due_date != null){
            $tasks = $tasks->where('due_date', '>=', $project_start_date)->where('due_date', '<=', $project_due_date);
        }

    @endphp

    <div class="row">
        <div class="col-md-8">
            <div class="project-tabs mb-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('team.tasks',$team->id) }}" wire:navigate class="nav-link @if($status=='all') active @endif" id="project-all-tab" data-bs-toggle="tab" data-bs-target="#project-all-tab-pane" type="button" role="tab" aria-controls="project-all-tab-pane" aria-selected="true">All <span class="ms-2">{{ $tasks->count() }}</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('team.tasks',['team'=>$team->id,'status'=>'pending']) }}" wire:navigate class="nav-link @if($status=='pending') active @endif" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="false" tabindex="-1">Active <span class="ms-2">
                            {{ $tasks->whereIn('status',['pending','assigned','in_progress','in_review'])->count() }}  
                        </span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('team.tasks',['team'=>$team->id,'status'=>'completed']) }}" wire:navigate class="nav-link @if($status=='completed') active @endif" id="project-done-tab" data-bs-toggle="tab" data-bs-target="#project-done-tab-pane" type="button" role="tab" aria-controls="project-done-tab-pane" aria-selected="false" tabindex="-1">Completed <span class="ms-2">{{ $tasks->where('status','completed')->count() }}  </span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('team.tasks',['team'=>$team->id,'status'=>'overdue']) }}" wire:navigate class="nav-link @if($status=='overdue') active @endif" id="project-overdue-tab" data-bs-toggle="tab" data-bs-target="#project-overdue-tab-pane" type="button" role="tab" aria-controls="project-overdue-tab-pane" aria-selected="false" tabindex="-1">Overdue <span class="ms-2">{{ $tasks->where('due_date', '<', Carbon\Carbon::now())->count() }} </span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 text-end">
            <div class="cus_dropdown" wire:ignore.self>
                <div class="cus_dropdown-icon btn-border btn-border-secondary"><i class="bx bx-filter-alt"></i> Filter</div>
                <div class="cus_dropdown-body cus_dropdown-body-widh_l">
                    <div class="cus_dropdown-body-wrap">
                        <div class="filterSort">
                            <h5 class="filterSort-header mt-4"><i class="bx bx-calendar-alt text-primary"></i> Filter By Date</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col mb-4 mb-md-0" wire:ignore>
                                    <a href="javascript:;" class="btn w-100 btn-sm btn-border-secondary start_date ">
                                        <i class="bx bx-calendar-alt"></i> Start Date
                                    </a>
                                </div>
                                <div class="col-auto text-center font-500 mb-4 mb-md-0 px-0">
                                    To
                                </div>
                                <div class="col" wire:ignore>
                                    <a href="javascript:;" class="btn w-100 btn-sm btn-border-danger due_date ">
                                        <i class="bx bx-calendar-alt"></i> Due Date
                                    </a>
                                </div>
                            </div> 
                            <h5 class="filterSort-header mt-4"><i class="bx bx-briefcase text-primary"></i> Filter By Clients</h5>
                            <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byClient" id="">
                                <option value="all" >Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                            <h5 class="filterSort-header mt-4"><i class="bx bx-objects-horizontal-left text-primary"></i> Filter By Projects</h5>
                            <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byProject" name="" id="">
                                <option value="all">Select Project</option>
                                @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                            <h5 class="filterSort-header mt-4"><i class="bx bx-user text-primary"></i> Filter By User</h5>
                            <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byUser" name="" id="">
                                <option value="all">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($this->doesAnyFilterApplied())
            <div class="col-md-6">
                <div class="d-flex flex-wrap gap-2 align-items-center justify-content-end mb-2">
                    <span class="pe-2"><i class='bx bx-filter-alt text-secondary'></i> Filter Results:</span>
                        @if($sort != 'all')
                            <span class="btn-batch">
                                @if($sort == 'newest') Newest @endif
                                @if($sort == 'oldest') Oldest @endif
                                @if($sort == 'a_z') A to Z @endif
                                @if($sort == 'z_a') Z to A @endif
                                <a wire:click="$set('sort','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                        @endif

                        @if($status != 'all')
                            <span class="btn-batch">
                                @if($status == 'pending') Assigned @endif
                                @if($status == 'overdue') Overdue @endif
                                @if($status == 'completed') Completed @endif
                                @if($status == 'in_progress') In Progress @endif
                                @if($status == 'in_review') In Review @endif
                                <a wire:click="$set('status','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                        @endif
                    
                        @if($byUser != 'all')
                            <span class="btn-batch">{{ $users->find($byUser)->name }} <a wire:click="$set('byUser','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                        @endif

                        @if($byClient != 'all')
                            <span class="btn-batch">{{ $clients->find($byClient)->name }} <a wire:click="$set('byClient','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                        @endif

                        @if($byProject != 'all')
                            <span class="btn-batch">{{ $projects->find($byProject)->name }} <a wire:click="$set('byProject','all')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                        @endif

                        @if($project_start_date)
                            <span class="btn-batch">{{ \Carbon\Carbon::parse($project_start_date)->format('d M Y') }} <a wire:click="$set('project_start_date','')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                        @endif

                        @if($project_due_date)
                            <span class="btn-batch">{{ \Carbon\Carbon::parse($project_due_date)->format('d M Y') }} <a wire:click="$set('project_due_date','')" class="ms-1"><i class='bx bx-x'></i></a></span> <span class="text-grey">|</span>
                        @endif
                        
                        <a href="{{ route('project.tasks',$project->id) }}" class="text-danger d-flex align-items-center">Reset <span class="ms-1 d-inline-flex"><i class='bx bx-refresh'></i></span></a>
                    </div>
            </div>
        @endif
    </div>
    <div class="column-box">
        <div class="taskList-dashbaord_header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="taskList-dashbaord_header_title taskList_col ms-2">Task Name</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Created Date</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Due Date</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Project</div>
                </div>
                <div class="col text-center">
                    <div class="taskList-dashbaord_header_title taskList_col">Assignee</div>
                </div>
            </div>
        </div>
       
        @foreach ($tasks as $task)
            <div class="taskList scrollbar">
                <div class="taskList_row">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="taskList_col taskList_col_title">
                                <div class="edit-task" data-id="100">
                                    <div>{{$task->name}} </div>
                                </div>
                            </div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList_col"><span>{{  Carbon\Carbon::parse($task->created_at)->format('d M Y') }}</span></div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList_col"><span>{{ Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</span></div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList_col"><span>{{$task->project->name}}</span></div>
                        </div>
                        <div class="col text-center">
                            <div class="taskList_col">
                                <div class="avatarGroup avatarGroup-overlap">

                                    @php
                                    $plus_more_users = 0;
                                        if(count($task->users) > 3){
                                            $plus_more_users = count($task->users) - 3;
                                        }
                                    @endphp

                                    @foreach($task->users->take(3) as $user)
                                    <a href="#" class="avatarGroup-avatar">
                                        <span class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$user->initials}}">{{$user->initials}}</span>
                                    </a>       
                                    @endforeach   
                                    @if($plus_more_users)
                                <a href="#" class="avatarGroup-avatar">
                                    <span class="avatar avatar-sm avatar-more">+{{$plus_more_users}}</span>
                                </a>
                            @endif                      
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <livewire:components.add-team @saved="$refresh" />
</div>

@script
    <script>
        $(document).ready(function() {
            flatpickr('.start_date', {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".start_date").html(dateStr);
                    @this.set('project_start_date', dateStr);
                },
            });


            flatpickr('.due_date', {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".due_date").html(dateStr);
                    @this.set('project_due_date', dateStr);
                },
            });

            });
    </script>
@endscript