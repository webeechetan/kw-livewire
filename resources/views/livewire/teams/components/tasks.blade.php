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
        $tasks_for_count = $team->tasks;

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

        if($startDate != null && $dueDate != null){
            $tasks = $tasks->where('due_date', '>=', $startDate)->where('due_date', '<=', $dueDate);
        }

    @endphp

    <div class="row">
        <div class="col-md-8">
            <div class="btn-list">
                <a wire:click="$set('status', 'all')" class="btn-border btn-border-primary @if($status == 'all') active @endif">
                    {{ $tasks_for_count->count() }} 
                    <span>|</span> 
                     All
                </a>
                <a wire:click="$set('status', 'pending')" class="btn-border btn-border-primary @if($status == 'pending') active @endif">{{ $tasks_for_count->where('status','pending')->count() }} <span>|</span> Assigned</a>
                <a wire:click="$set('status', 'in_progress')" class="btn-border btn-border-secondary @if($status == 'in_progress') active @endif">{{ $tasks_for_count->where('status','in_progress')->count() }} <span>|</span> Accepted</a>
                <a wire:click="$set('status', 'in_review')" class="btn-border btn-border-warning @if($status == 'in_review') active @endif">{{ $tasks_for_count->where('status','in_review')->count() }} <span>|</span> In Review</a>
                <a wire:click="$set('status', 'completed')" class="btn-border btn-border-success @if($status == 'completed') active @endif">{{ $tasks_for_count->where('status','completed')->count() }} <span>|</span> Completed</a>
                <a wire:click="$set('status', 'overdue')" class="btn-border btn-border-danger @if($status == 'overdue') active @endif">
                    @php
                        $overdue = $tasks_for_count->where('due_date', '<', now())->count();
                    @endphp
                    {{ $overdue }}
                    <span>|</span> Overdue</a>
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
                                <option value="all" disabled>Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                            <h5 class="filterSort-header mt-4"><i class="bx bx-objects-horizontal-left text-primary"></i> Filter By Projects</h5>
                            <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byProject" name="" id="">
                                <option value="all" disabled>Select Project</option>
                                @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                            <h5 class="filterSort-header mt-4"><i class="bx bx-user text-primary"></i> Filter By User</h5>
                            <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byUser" name="" id="">
                                <option value="all" disabled>Select User</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="space-sm">
    <div class="col-md-12 d-flex justify-content-end">
        <form class="search-box search-box-float-style" wire:submit.prevent="search">
            <span class="search-box-float-icon"><i class='bx bx-search'></i></span>
            <input type="text" wire:model="query" class="form-control" placeholder="Search Task...">
        </form>
    </div>
    
    <div class="column-box">
    @if($this->doesAnyFilterApplied())
            <x-filters-query-params 
                :sort="$sort" 
                :status="$status" 
                :byUser="$byUser" 
                :byClient="$byClient"
                :byProject="$byProject"
                :startDate="$startDate" 
                :dueDate="$dueDate" 
                :users="$users" 
                :teams="$teams"
                :clients="$clients"
                :projects="$projects" 
                :clearFilters="route('team.tasks',$team)"
            />
        @endif
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
       
        @if($tasks->isNotEmpty())
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
                            <div class="taskList_col"><span> @if($task->due_date)
                                {{ Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                            @else
                                No Due Date
                            @endif</span></div>
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
                                    {{-- <a href="#" class="avatarGroup-avatar">
                                        <span class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$user->initials}}">{{$user->initials}}</span>
                                    </a>        --}}
                                    <x-avatar :user="$user" class="avatar-sm" />
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
        @else
        <div class="col-md-12 text-center py-4">               
            <img src="{{ asset('assets/images/'.'invite_signup_img.png') }}" width="150" alt="">
            <h5 class="text text-light mt-3">No Task found</h5>
        </div>
    @endif
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
                    @this.set('startDate', dateStr);
                },
            });


            flatpickr('.due_date', {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    $(".due_date").html(dateStr);
                    @this.set('dueDate', dateStr);
                },
            });

            });
    </script>
@endscript