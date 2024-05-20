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
      <div class="col-lg-4">
         <div class="column-box states_style-progress h-100">
            <div class="row align-items-center">
               <div class="col-auto">
                  <div class="states_style-icon">
                     <i class='bx bx-layer'></i>
                  </div>
               </div>
               <div class="col">
                  <div class="row align-items-center g-2">
                     <div class="col-auto">
                        <h5 class="title-md mb-0">{{$team->projects->count()}}</h5>
                     </div>
                     <div class="col-auto">
                        <span class="font-400 text-grey">|</span>
                     </div>
                     <div class="col-auto">
                        <div class="states_style-text">Clients</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="column-box states_style-active h-100">
            <div class="row align-items-center">
               <div class="col-auto">
                  <div class="states_style-icon">
                     <i class='bx bx-layer'></i>
                  </div>
               </div>
               <div class="col">
                  <div class="row align-items-center g-2">
                     <div class="col-auto">
                        <h5 class="title-md mb-0"> {{ $team->projects->count() }} </h5>
                     </div>
                     <div class="col-auto">
                        <span class="font-400 text-grey">|</span>
                     </div>
                     <div class="col-auto">
                        <div class="states_style-text">Projects</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="column-box states_style-success h-100">
            <div class="row align-items-center">
               <div class="col-auto">
                  <div class="states_style-icon">
                     <i class='bx bx-layer'></i>
                  </div>
               </div>
               <div class="col">
                  <div class="row align-items-center g-2">
                     <div class="col-auto">
                        <h5 class="title-md mb-0">{{ $team->users->count() }}</h5>
                     </div>
                     <div class="col-auto">
                        <span class="font-400 text-grey">|</span>
                     </div>
                     <div class="col-auto">
                        <div class="states_style-text">Members</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="column-box mb-4">
      <div class="row align-items-center">
         <div class="col-sm-auto pe-5">
            <h5 class="column-title mb-0">Clients</h5>
         </div>
         <div class="col">
            <!-- Teams -->
            <div class="team-list row">
               @foreach($team->projects as $project)
               <div class="col-auto">
                  <div class="card_style-client-head taskList_col border rounded-3 me-0">
                     <div class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$project->name}}">{{$project->initials}}</div>
                     <div>
                        <h6 class="mb-0">
                           <a href="{{route('client.profile',$project->id)}}" wire:navigate="">{{$project->client->name}}</a>
                        </h6>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
   <div class="column-box mb-3">
      <div class="d-flex flex-wrap gap-20 align-items-center">
         <div>
            <h5 class=" column-title mb-0">Projects</h5>
         </div>
      </div>
   </div>
   <div class="project-tabs mb-2">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
         <li class="nav-item" role="presentation">
            <button class="nav-link active" id="project-all-tab" data-bs-toggle="tab" data-bs-target="#project-all-tab-pane" type="button" role="tab" aria-controls="project-all-tab-pane" aria-selected="true">All <span class="ms-2">{{ $team->projects->count() }}</span></button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="false" tabindex="-1">Active <span class="ms-2">
               {{ $team->projects->where('status','active')->count() }}   
            </span></button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="project-done-tab" data-bs-toggle="tab" data-bs-target="#project-done-tab-pane" type="button" role="tab" aria-controls="project-done-tab-pane" aria-selected="false" tabindex="-1">Completed <span class="ms-2">{{ $team->projects->where('status','completed')->count() }}   </span></button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="project-overdue-tab" data-bs-toggle="tab" data-bs-target="#project-overdue-tab-pane" type="button" role="tab" aria-controls="project-overdue-tab-pane" aria-selected="false" tabindex="-1">Overdue <span class="ms-2">{{ $team->projects->where('status','overdue')->count() }}   </span></button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="project-archived-tab" data-bs-toggle="tab" data-bs-target="#project-archived-tab-pane" type="button" role="tab" aria-controls="project-archived-tab-pane" aria-selected="false" tabindex="-1">Archive <span class="ms-2">{{ $team->projects->where('status','archived')->count() }}   </span></button>
         </li>
      </ul>
   </div>
   <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade active show" id="project-all-tab-pane" role="tabpanel" aria-labelledby="project-all-tab" tabindex="0">
         <div class="row">
            @foreach($team->projects as $project)
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
            @foreach($team->projects as $project)
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
            @foreach($team->projects as $project)
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
         @foreach($team->projects as $project)
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
            @foreach($team->projects as $project)
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
   <div class="row mt-4">
      <div class="col-lg-12">
         <h5 class="column-title mb-3">Member</h5>
      </div>
      <div class="col-md-12">
         <div class="column-box">
               <div class="taskList-dashbaord_header">
                  <div class="row">
                     <div class="col-md-4">
                           <div class="taskList-dashbaord_header_title taskList_col">Name</div>
                     </div>
                     <div class="col text-center">
                           <div class="taskList-dashbaord_header_title taskList_col">Position</div>
                     </div>
                     <div class="col text-center">
                           <div class="taskList-dashbaord_header_title taskList_col">Status</div>
                     </div>
                     <div class="col text-center">
                           <div class="taskList-dashbaord_header_title taskList_col">Action</div>
                     </div>
                  </div>
               </div>
               <div class="taskList scrollbar">
                  @foreach($team->users as  $user)
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Himanshu Sharma">HS</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="{{route('user.profile',$user->id)}}" wire:navigate="">{{$user->name }}</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Jr. Web Developer</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-success">Active</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  @endforeach
               </div>
         </div>
      </div>
   </div>
   <livewire:components.add-team @saved="$refresh" />
</div>