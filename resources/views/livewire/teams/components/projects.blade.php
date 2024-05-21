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
      <div class="col-sm-4">
         <div class="column-box py-2">
            <div class="d-flex align-items-center">
               <label for="" class="font-500"><i class='bx bx-briefcase-alt-2 text-primary' ></i> Filter By Client</label>
               <select class="dashboard_filters-select ms-auto w-200" name="" id="">
                  <option value="" disabled="">Select Client</option>
                  <option value="1">Acma</option>
                  <option value="2">Buyers Guide</option>
                  <option value="3">GRG</option>
                  <option value="4">Webeesocial</option>
               </select>
            </div>
         </div>
      </div>
      <div class="col-sm-4">
         <div class="column-box py-2">
            <div class="d-flex align-items-center">
               <label for="" class="font-500"><i class='bx bx-user text-secondary'></i> Filter By User</label>
               <select class="dashboard_filters-select ms-auto w-200" name="" id="">
                  <option value="" disabled="">Select Client</option>
                  <option value="1">Acma</option>
                  <option value="2">Buyers Guide</option>
                  <option value="3">GRG</option>
                  <option value="4">Webeesocial</option>
               </select>
            </div>
         </div>
      </div>
      <div class="col-sm-4">
         <div class="column-box py-2">
            <div class="d-flex align-items-center">
               <label for="" class="font-500"><i class='bx bx-calendar-alt text-success' ></i> Filter By Date</label>
               <input type="date" class="dashboard_filters-select ms-auto w-200">
            </div>
         </div>
      </div>
   </div>

   <!-- Projects -->
   <div class="project-tabs mb-2">
      <div class="row">
         <div class="col-sm-7">
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
      </div>
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
</div>