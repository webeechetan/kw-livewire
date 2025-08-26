<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i>{{ ucfirst(Auth::user()->organization->name) }}</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('task.index') }}">Tasks</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
    </nav>

    <!-- Dashboard Header --> 
    <div class="dashboard-head pb-0 mb-4">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">Tasks</h3>
                <span class="text-light">|</span>
                @can('Create Task')
                    <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" href="javascript:void(0);" class="btn-border btn-sm btn-border-primary toggleForm"><i class="bx bx-plus"></i> Add Task</a>
                @endcan
            </div> 
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" wire:submit="search" action="">
                        <input wire:model="query" type="text" class="form-control" placeholder="Search Task">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                    <div class="main-body-header-filters">
                        @include('components.filter-popover')
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-0">
        <div class="row align-items-center">
            <div class="col-md-6">
                <!-- Tabs -->
                <div class="tabNavigationBar-tab border_style">
                    <a wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.index') active @endif" href="{{ route('task.index') }}">
                        <i class='bx bx-columns'></i> My Tasks
                    </a>
                    @can('View Project')
                    <a wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.projects') active @endif" href="{{ route('task.projects') }}">
                        <i class='bx bx-objects-horizontal-left'></i> 
                        @if(auth()->user()->hasRole('Admin'))
                            Projects
                        @else
                            My Projects
                        @endif
                    </a>
                    @endcan
                    @can('View Team')

                    <a wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.teams') active @endif" href="{{ route('task.teams') }}">
                        <i class='bx bx-sitemap'></i> 
                        @if(auth()->user()->hasRole('Admin'))
                            Teams
                        @else
                            My Teams
                        @endif 
                    </a>
                    @endcan

                    <a wire:navigate class="tabNavigationBar-item @if($currentRoute == 'task.marked-to-me') active @endif" href="{{ route('task.marked-to-me') }}">
                        <i class='bx bx-user'></i> Marked To Me
                    </a>
                
                </div>
            </div> 
            <div class="col-md-6 text-end">
                <select class="dashboard_filters-select" wire:model.live="byProject" id="">
                    <option value="all">All Projects</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                
            </div>
        </div>
    </div>

    <div class="btn-list">
        <a wire:click="$set('status', 'all')" class="btn-border btn-border-primary @if($status == 'all') active @endif">
            {{-- {{ $tasks['pending']->count() + $tasks['in_progress']->count() + $tasks['in_review']->count() + $tasks['completed']->count() }}  --}}
            {{ $allTasks}}
            <span>|</span> 
             All 
        </a>
        <a  wire:click="$set('status', 'pending')" class="btn-border btn-border-primary @if($status == 'pending') active @endif">{{ $pendingTasks}} <span>|</span> Assigned</a>
        <a  wire:click="$set('status', 'in_progress')" class="btn-border btn-border-secondary @if($status == 'in_progress') active @endif">{{ $inProgressTasks}} <span>|</span> Accepted</a>
        <a  wire:click="$set('status', 'in_review')" class="btn-border btn-border-warning @if($status == 'in_review') active @endif">{{  $inReviewTasks }} <span>|</span> In Review</a>
        <a  wire:click="$set('status', 'completed')" class="btn-border btn-border-success @if($status == 'completed') active @endif">{{ $completedTasks }} <span>|</span> Completed</a>
        <a wire:click="$set('status', 'overdue')" class="btn-border btn-border-danger @if($status == 'overdue') active @endif">
           {{ $overdueTasks }}
            <span>|</span> Overdue
        </a>
        <div class="col-md-6">
            @if($this->doesAnyFilterApplied())
                <x-filters-query-params 
                    :sort="$sort" 
                    :status="$status" 
                    :byUser="$byUser" 
                    :byProject="$byProject"
                    :byClient="$byClient"
                    :byTeam="$byTeam"
                    :startDate="$startDate"
                    :dueDate="$dueDate"
                    :users="$users"  
                    :projects="$projects"
                    :teams="$teams"
                    :clients="$clients"
                    :clearFilters="route('task.projects')"
                />
            @endif
        </div>
    </div>

    <div class="column-box mt-3">
        <div class="taskList-dashbaord_header">
            <div class="taskList-dashbaord_header_title taskList_col ms-2">Task Name</div>
            <div class="taskList-dashbaord_header_wrap text-center d-grid grid_col-repeat-6">
                <div class="taskList-dashbaord_header_title taskList_col">Due Date</div>
                <div class="taskList-dashbaord_header_title taskList_col">Client</div>
                <div class="taskList-dashbaord_header_title taskList_col">Project</div>
                <div class="taskList-dashbaord_header_title taskList_col">Assignee</div>
                <div class="taskList-dashbaord_header_title taskList_col">Assignor</div>
                <div class="taskList-dashbaord_header_title taskList_col">Status</div>
            </div>
        </div>

       
        <div class="taskList scrollbar">
            <div>
                @foreach($tasks as $task)
                    <x-table-row :task="$task"/>
                @endforeach

                <!--- Pagination -->
                @if(!$tasks)
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('assets/images/'.'invite_signup_img.png') }}" width="150" alt="">
                        <h5 class="text text-light mt-3">No Tasks found</h5>
                    </div>
                @endif
            </div>
        </div>
        <div class="pagination-wrap">
            {{ $tasks->links() }}
        </div>
    </div>

</div>

@script
    <script>
        document.addEventListener('saved', function(){
            $('#offcanvasRight').offcanvas('hide');
        });

        $(document).on('click', '.edit-task', function(){
            let taskId = $(this).data('id');
            @this.emitEditTaskEvent(taskId);
        });

        $(".start_date").flatpickr({
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance){
                @this.set('startDate', dateStr);
                $(".start_date").text(dateStr);
            }
        });

        $(".due_date").flatpickr({
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance){
                @this.set('dueDate', dateStr);
                $(".due_date").text(dateStr);
            }
        });

        $(".task-switch").change(function(){ 
            if($(this).is(':checked')){
                @this.set('ViewTasksAs', 'manager');
            }else{
                @this.set('ViewTasksAs', 'user');
            }
        });

        $(".assigned-by-me-task-task-switch").change(function(){
            if($(this).is(':checked')){
                @this.set('assignedByMe', true);
            }else{
                @this.set('assignedByMe', false);
            }
        });
    </script>
@endscript


