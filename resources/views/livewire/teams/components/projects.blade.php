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
   <!-- Projects -->
   @php
      $projects = $team->projects;

      if($start_date && $end_date){
         $projects = $projects->whereBetween('due_date',[$start_date,$end_date]);
      }

      if($filterByClient){
         $projects = $projects->where('client_id',$filterByClient);
      }
      
      if($filterByUser){
        
         $projects = \App\Models\User::find($filterByUser)->projects;
      }

////////////////////////////////
      if($byClient != 'all'){
            $projects = $projects->where('client_id', $byClient);
        }


        if($this->byUser != 'all'){
            $user = \App\Models\User::find($this->byUser);
            if($user){
                $projectsIds = $user->projects->pluck('id')->toArray();
                $projects =  $projects->whereIn('id',$projectsIds);
            }
        }

      
        if($project_start_date != null && $project_due_date != null){

            $projects = $projects->where('due_date', '>=', $project_start_date)->where('due_date', '<=', $project_due_date);
        }



   @endphp
   <div class="project-tabs mb-2">
      <div class="row">
         <div class="col-sm-7">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="project-all-tab" data-bs-toggle="tab" data-bs-target="#project-all-tab-pane" type="button" role="tab" aria-controls="project-all-tab-pane" aria-selected="true">All <span class="ms-2">{{ $projects->count() }}</span></button>
               </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="false" tabindex="-1">Active <span class="ms-2">
                   {{ $projects->count() }}   
                  </span></button>
               </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="project-done-tab" data-bs-toggle="tab" data-bs-target="#project-done-tab-pane" type="button" role="tab" aria-controls="project-done-tab-pane" aria-selected="false" tabindex="-1">Completed <span class="ms-2">{{ $projects->where('status','completed')->count() }}   </span></button>
               </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="project-overdue-tab" data-bs-toggle="tab" data-bs-target="#project-overdue-tab-pane" type="button" role="tab" aria-controls="project-overdue-tab-pane" aria-selected="false" tabindex="-1">Overdue <span class="ms-2">{{ $projects->where('status','overdue')->count() }}   </span></button>
               </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="project-archived-tab" data-bs-toggle="tab" data-bs-target="#project-archived-tab-pane" type="button" role="tab" aria-controls="project-archived-tab-pane" aria-selected="false" tabindex="-1">Archive <span class="ms-2">{{ $projects->where('status','archived')->count() }}   </span></button>
               </li>
            </ul>

            {{-- <div class="dashboard_filters d-flex flex-wrap gap-4 align-items-center mb-4">
               <a class="@if($filter == 'all') active @endif" wire:navigate href="{{ route('team.projects',$team->id) }}">All <span class="btn-batch">{{ $projects->count() }}</span></a>
               <a class="@if($filter == 'active') active @endif" wire:navigate href="{{ route('team.projects',['team'=>$team->id,'status'=>'active']) }}">Active <span class="btn-batch">{{ $projects->where('status', 'active')->count() }}</span></a>
               <a class="@if($filter == 'overdue') active @endif" wire:navigate href="{{ route('team.projects',['team'=>$team->id,'sort'=>$sort,'filter'=>'overdue']) }}">Overdue <span class="btn-batch">{{ $projects->where('due_date', '<', now())->count()}}</span></a>
               <a class="@if($filter == 'completed') active @endif" wire:navigate href="{{ route('team.projects',['team'=>$team->id,'sort'=>$sort,'filter'=>'completed']) }}">Completed <span class="btn-batch">{{ $projects->where('status','completed')->count() }}</span></a>
               <a class="@if($filter == 'archived') active @endif" wire:navigate href="{{ route('team.projects',['team'=>$team->id,'sort'=>$sort,'filter'=>'archived']) }}">Archive <span class="btn-batch">{{ $projects->where('status', 'archived')->count() }}</span></a>
           </div>  --}}
         </div>

         {{-- ///sdfsdfgsdfg/ --}}
         <div class="col-md-5 text-end">
            <div class="cus_dropdown">
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
      </div>


      <div class="tab-content" id="myTabContent">
         <div class="tab-pane fade active show" id="project-all-tab-pane" role="tabpanel" aria-labelledby="project-all-tab" tabindex="0">
            <div class="row">
             
               @foreach($projects as $project)

               {{-- {{$project}} --}}
               <div class="col-lg-3">
                  <div class="project-list">
                     <div class="project project-align_left w-100">
                        <div class="project-icon"><i class="bx bx-layer"></i></div>
                        <div class="project-content">
                           <a href="{{ route('project.profile',$project->id) }}" class="project-title">{{$project->name}}</a>
                           <div class="project-selected-date">Due on <span>{{  \Carbon\Carbon::parse($project->due_date)->diffForHumans()}}</span></div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         <div class="tab-pane fade" id="project-active-tab-pane" role="tabpanel" aria-labelledby="project-active-tab" tabindex="0">
            <div class="row">
               @foreach($projects as $project)
                  @if($project->status != 'active')
                     @continue
                  @endif
                  <div class="col-lg-3">
                     <div class="project-list">
                        <div class="project project-align_left w-100">
                           <div class="project-icon"><i class="bx bx-layer"></i></div>
                           <div class="project-content">
                              <a href="{{ route('project.profile',$project->id) }}" class="project-title">{{$project->name}}</a>
                              <div class="project-selected-date">Due on <span>{{  \Carbon\Carbon::parse($project->due_date)->diffForHumans()}}</span></div>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
         <div class="tab-pane fade" id="project-done-tab-pane" role="tabpanel" aria-labelledby="project-done-tab" tabindex="0">
            <div class="row">
               @foreach($projects as $project)
                  @if($project->status != 'completed')
                     @continue
                  @endif
                  <div class="col-lg-3">
                     <div class="project-list">
                        <div class="project project-align_left w-100">
                           <div class="project-icon"><i class="bx bx-layer"></i></div>
                           <div class="project-content">
                              <a href="{{ route('project.profile',$project->id) }}" class="project-title">{{$project->name}}</a>
                              <div class="project-selected-date">Due on <span>{{  \Carbon\Carbon::parse($project->due_date)->diffForHumans()}}</span></div>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
         <div class="tab-pane fade" id="project-overdue-tab-pane" role="tabpanel" aria-labelledby="project-overdue-tab" tabindex="0">
           <div class="row">
            @foreach($projects as $project)
            @if($project->status != 'overdue')
               @continue
            @endif
            <div class="col-lg-3">
               <div class="project-list">
                  <div class="project project-align_left w-100">
                     <div class="project-icon"><i class="bx bx-layer"></i></div>
                     <div class="project-content">
                        <a href="{{ route('project.profile',$project->id) }}" class="project-title">{{$project->name}}</a>
                        <div class="project-selected-date">Due on <span>{{  \Carbon\Carbon::parse($project->due_date)->diffForHumans()}}</span></div>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
           </div>
         </div>
         <div class="tab-pane fade" id="project-archived-tab-pane" role="tabpanel" aria-labelledby="project-archived-tab" tabindex="0">
            <div class="row">
               @foreach($projects as $project)
               @if($project->status != 'archived')
                  @continue
               @endif
               <div class="col-lg-3">
                  <div class="project-list">
                     <div class="project project-align_left w-100">
                        <div class="project-icon"><i class="bx bx-layer"></i></div>
                        <div class="project-content">
                           <a href="{{ route('project.profile',$project->id) }}" class="project-title">{{$project->name}}</a>
                           <div class="project-selected-date">Due on <span>{{  \Carbon\Carbon::parse($project->due_date)->diffForHumans()}}</span></div>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
            </div>
         </div>
      </div>

      {{--  <div class="column-box">
         <div class="taskList-dashbaord_header">
             <div class="row">
                 <div class="col-lg-6">
                     <div class="taskList-dashbaord_header_title taskList_col ms-2">Project Name</div>
                 </div>
                 <div class="col text-center">
                     <div class="taskList-dashbaord_header_title taskList_col">Created Date</div>
                 </div>
                 <div class="col text-center">
                     <div class="taskList-dashbaord_header_title taskList_col">Due On</div>
                 </div>
                 <div class="col text-center">
                     <div class="taskList-dashbaord_header_title taskList_col">Assignee</div>
                 </div>
             </div>
         </div>
        
         @foreach ($projects as $project)
             <div class="taskList scrollbar">
                 <div class="taskList_row">
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="taskList_col taskList_col_title">
                                 <div class="edit-task" data-id="100">
                                    <a href="{{ route('project.profile',$project->id) }}" class="project-title">{{$project->name}}</a>
                                 </div>
                             </div>
                         </div>
                         <div class="col text-center">
                             <div class="taskList_col"><span>{{  Carbon\Carbon::parse($project->created_at)->format('d M Y') }}</span></div>
                         </div>
                         <div class="col text-center">
                             <div class="taskList_col"><span>{{  \Carbon\Carbon::parse($project->due_date)->diffForHumans()}}</span></div>
                         </div>
                        
                         <div class="col text-center">
                             <div class="taskList_col">
                                 <div class="avatarGroup avatarGroup-overlap">
                                  @foreach($task->users as $user)
                                     <a href="#" class="avatarGroup-avatar">
                                         <span class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$user->initials}}">{{$user->initials}}</span>
                                     </a>       
                                     @endforeach                         
                                 </div>
                                 
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         @endforeach
     </div> --}}


   </div>
   
</div>

@script
<script>
   $(document).ready(function(){
      // $('.filter-projects-by-date').flatpickr({
      //    mode: "range",
      //    onChange: function(selectedDates, dateStr, instance){
      //       let date = dateStr.split(' to ');
      //       let startDate = date[0];
      //       let endDate = date[1];
      //       @this.set('start_date',startDate);
      //       @this.set('end_date',endDate);
      //    }
      // }); 

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