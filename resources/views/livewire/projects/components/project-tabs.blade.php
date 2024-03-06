<div>
    <div>
        <div class="dashboard-head">
            <div class="row align-items-center">
                <div class="col">
                    <div class="dashboard-head-title-wrap">
                        <div class="client_head_logo"><img src="{{ asset('storage/'.$project->client->image) }}" alt=""></div>
                        <div>
                            <div class="client_head-date">{{ \Carbon\Carbon::parse($project->start_date)->format('d M-Y') }}</div>
                            <h3 class="main-body-header-title mb-0">{{ $project->name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="text-end col">
                    <div class="main-body-header-right">
                        <!-- Edit -->
                        <div class="cus_dropdown">
                            <!-- For Active Class = btn-border-success | For Archived Class = btn-border-archived -->
                            <div class="cus_dropdown-icon btn-border btn-border-success">Active <i class='bx bx-chevron-down' ></i></div>
                            <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                <div class="cus_dropdown-body-wrap">
                                    <ul class="cus_dropdown-list">
                                        <li><a href="javascript:" wire:click="changeProjectStatus('active')" class="active"><span><i class='bx bx-user-check' ></i></span> Active</a></li>
                                        <li><a href="javascript:" wire:click="changeProjectStatus('completed')"><span><i class='bx bx-user-minus' ></i></span> Completed</a></li>
                                        <li><a href="javascript:" wire:click="emitDeleteProjectEvent({{$project->id}})"><span><i class='bx bx-user-minus' ></i></span> Archived</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:" wire:click="emitEditProjectEvent({{ $project->id }})" class="btn-sm btn-border btn-border-secondary"><i class='bx bx-pencil'></i> Edit</a>
                        <a href="javascript:" wire:click.confirm="emitDeleteProjectEvent({{ $project->id }})" class="btn-sm btn-border btn-border-danger"><i class='bx bx-trash'></i> Delete</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabNavigationBar-tab border_style mb-3">
            <a href="{{ route('project.profile',$project->id) }}" class="tabNavigationBar-item @if(request()->routeIs('project.profile')) active @endif" wire:navigate ><i class='bx bx-line-chart'></i> Overview</a>
            <a href="{{ route('project.tasks',$project->id) }}" class="tabNavigationBar-item @if(request()->routeIs('project.tasks')) active @endif" wire:navigate><i class='bx bx-layer' ></i> Tasks</a>
            <a href="{{ route('project.file-manager',$project->id) }}" class="tabNavigationBar-item @if(request()->routeIs('project.file-manager')) active @endif" wire:navigate><i class='bx bx-objects-horizontal-left' ></i> File Manager</a>
        </div>
    </div>
    <livewire:components.add-project @saved="$refresh" />
</div>
