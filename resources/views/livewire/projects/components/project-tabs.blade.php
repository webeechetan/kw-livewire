<div>
    <div class="dashboard-head pb-0 mb-4 @if($project->trashed()) archived_content @endif">
        <div class="row align-items-center">
            <div class="col">
                <div class="dashboard-head-title-wrap">
                    <div class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ac">{{$project->initials}}</div>
                    <div>
                        <h3 class="main-body-header-title mb-2">{{ $project->name }}</h3>
                        <div class="text-sm text-uppercase">{{$project->client->name}}</div>
                    </div>
                </div>
            </div>
            <div class="text-end col">
                <div class="main-body-header-right">
                    @can('Edit Project')
                    <!-- Edit -->
                    <div class="cus_dropdown">
                        <!-- For Active Class = btn-border-success | For Archived Class = btn-border-archived -->

                        @if(!$project->trashed())
                        <div class="cus_dropdown-icon btn-border btn-border-success">Active <i class='bx bx-chevron-down' ></i></div>
                        @else
                        <div class="cus_dropdown-icon btn-border btn-border-archived">Archived <i class='bx bx-chevron-down' ></i></div>
                        @endif
                        <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                            <div class="cus_dropdown-body-wrap">
                                <ul class="cus_dropdown-list">
                                    <li><a href="javascript:" wire:click="changeProjectStatus('active')" @if(!$project->trashed()) class="active" @endif>Active</a></li>
                                    <li><a href="javascript:" wire:click="changeProjectStatus('completed')" @if($project->status == 'completed') class="active" @endif>Completed</a></li>
                                    <li><a href="javascript:" wire:click="emitDeleteProjectEvent({{$project->id}})" @if($project->trashed()) class="active" @endif>Archived</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:" wire:click="emitEditProjectEvent({{ $project->id }})" class="btn-sm btn-border btn-border-secondary"><i class='bx bx-pencil'></i> Edit</a>
                    @endcan
                    @can('Delete Project')
                    {{-- <a href="javascript:" wire:click.confirm="emitDeleteProjectEvent({{ $project->id }})" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a> --}}
                    <a href="javascript:" wire:click="forceDeleteProject({{ $project->id }})" wire:confirm="Are you sure you want to delete?" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a>
                    @endcan
                </div>
            </div>
        </div>
        <hr class="mb-0">
        <div class="tabNavigationBar-tab border_style">
            <a href="{{ route('project.profile',$project->id) }}" class="tabNavigationBar-item @if(request()->routeIs('project.profile')) active @endif" wire:navigate ><i class='bx bx-line-chart'></i> Overview</a>
            <a href="{{ route('project.tasks',$project->id) }}" class="tabNavigationBar-item @if(request()->routeIs('project.tasks')) active @endif"><i class='bx bx-layer' ></i> Tasks</a>
            <a href="{{ route('project.file-manager',$project->id) }}" class="tabNavigationBar-item @if(request()->routeIs('project.file-manager')) active @endif" wire:navigate><i class='bx bx-objects-horizontal-left' ></i> File Manager</a>
        </div>
    </div>
    <livewire:components.add-project @saved="$refresh" />
</div>
