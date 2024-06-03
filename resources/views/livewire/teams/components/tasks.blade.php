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
    <div class="row mb-4">
        <div class="col-sm-3">
            <div class="column-box">
                <label for="" class="font-500"><i class='bx bx-briefcase-alt-2 text-primary' ></i> Filter By Client</label>
                <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byClient" id="">
                    <option value="all" >Select Client</option>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="column-box">
                <label for="" class="font-500"><i class='bx bx-objects-horizontal-left text-warning' ></i> Filter By Project</label>
                <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byProject" name="" id="">
                    <option value="all">Select Project</option>
                    @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="column-box">
                <label for="" class="font-500"><i class='bx bx-user text-secondary'></i> Filter By User</label>
                <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byUser" name="" id="">
                    <option value="all">Select User</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="column-box">
                <label for="" class="font-500"><i class='bx bx-calendar-alt text-success' ></i> Filter By Date</label>
                <div class="row align-items-center mt-2">
                    <div class="col mb-4 mb-md-0">
                        <a href="javascript:;" class="btn w-100 btn-sm btn-border-secondary project_start_date"><i class='bx bx-calendar-alt' ></i> Start Date</a>
                    </div>
                    <div class="col-auto text-center font-500 mb-4 mb-md-0 px-0">To</div>
                    <div class="col">
                        <a href="javascript:;" class="btn w-100 btn-sm btn-border-danger project_due_date"><i class='bx bx-calendar-alt' ></i> Due Date</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="project-tabs mb-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="project-all-tab" data-bs-toggle="tab" data-bs-target="#project-all-tab-pane" type="button" role="tab" aria-controls="project-all-tab-pane" aria-selected="true">All <span class="ms-2">{{ $team->tasks->count() }}</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="false" tabindex="-1">Active <span class="ms-2">
                    {{ $team->projects->where('status','active')->count() }}  {{$activeTasks}} 
                </span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-done-tab" data-bs-toggle="tab" data-bs-target="#project-done-tab-pane" type="button" role="tab" aria-controls="project-done-tab-pane" aria-selected="false" tabindex="-1">Completed <span class="ms-2">{{ $team->tasks->where('status','completed')->count() }} {{$completedTasks}}  </span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-overdue-tab" data-bs-toggle="tab" data-bs-target="#project-overdue-tab-pane" type="button" role="tab" aria-controls="project-overdue-tab-pane" aria-selected="false" tabindex="-1">Overdue <span class="ms-2">{{ $team->projects->where('status','overdue')->count() }} {{$overDueTasks}}  </span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-archived-tab" data-bs-toggle="tab" data-bs-target="#project-archived-tab-pane" type="button" role="tab" aria-controls="project-archived-tab-pane" aria-selected="false" tabindex="-1">Archive <span class="ms-2">{{ $team->projects->where('status','archived')->count() }} {{$cancelledTasks}}  </span></button>
            </li>
        </ul>
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
       
        @php
            $tasks = $team->tasks;
            if($byClient != 'all'){
                $tasks = $tasks->where('client_id', $byClient);
            }

            if($byProject != 'all'){
                $tasks = $tasks->where('project_id', $byProject);
            }

            // if($byUser != 'all'){
            //     $user = User::find($this->byUser);
            //     if($user){
            //         $tasksIds = $user->tasks->pluck('id')->toArray();
            //         $tasks->whereIn('id',$tasksIds);
            //     }
            // }

        @endphp

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
                                    <a href="#" class="avatarGroup-avatar">
                                        <span class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$task->assignedBy->initials}}">{{$task->assignedBy->name}}</span>
                                    </a>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


@assets
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endassets

@script
    <script>
        $(document).ready(function() {
            flatpickr('.project_start_date', {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".project_start_date").html(dateStr);
                    @this.set('project_start_date', dateStr);
                },
            });


            flatpickr('.project_due_date', {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".project_due_date").html(dateStr);
                    @this.set('project_due_date', dateStr);
                },
            });

            });
    </script>
@endscript