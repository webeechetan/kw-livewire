<div>
    <div class="client-tab">
        <div class="dashboard-head mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="dashboard-head-title-wrap">
                        <div class="client_head_logo"><img src="{{ env('APP_URL') }}/storage/{{ $client->image }}" alt=""></div>
                        <div>
                            <h3 class="main-body-header-title mb-0">{{ $client->visible_name }}</h3>
                            <div class="client_head-date">
                                {{ \Carbon\Carbon::parse($client->onboard_date)->format('d M-Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end col">
                    <div class="main-body-header-right">
                        <!-- Edit -->
                        <div class="cus_dropdown">
                            <!-- For Active Class = btn-border-success | For Archived Class = btn-border-archived -->
                            @if(!$client->trashed())
                                <div class="cus_dropdown-icon btn-border btn-border-success">Active <i class='bx bx-chevron-down' ></i></div>
                            @else
                                <div class="cus_dropdown-icon btn-border btn-border-archived">Archived <i class='bx bx-chevron-down' ></i></div>
                            @endif

                            <div class="cus_dropdown-body cus_dropdown-body-widh_s">
                                <div class="cus_dropdown-body-wrap">
                                    <ul class="cus_dropdown-list">
                                        <li><a href="javascript:;" wire:click="changeClientStatus('active')" @if(!$client->trashed()) class="active" @endif>Active</a></li>
                                        <li><a href="javascript:;" wire:click="changeClientStatus('archived')" @if($client->trashed()) class="active" @endif>Archive</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <button @if($client->trashed()) disabled @endif wire:click="emitEditClient({{$client->id}})" class="btn-sm btn-border btn-border-secondary "><i class='bx bx-pencil'></i> Edit</button>
                        <a href="#" class="btn-sm btn-border btn-border-danger" wire:click="forceDeleteClient({{$client->id}})"><i class='bx bx-trash'></i> Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabNavigationBar-tab border_style mb-3">
            <a wire:navigate class="tabNavigationBar-item @if(request()->routeIs('client.profile')) active @endif" href="{{ route('client.profile', $client->id) }}"><i class='bx bx-line-chart'></i> Overview</a>
            <a wire:navigate class="tabNavigationBar-item @if(request()->routeIs('client.projects')) active @endif" href="{{ route('client.projects', $client->id) }}"><i class='bx bx-layer' ></i> Projects</a>
            <a wire:navigate class="tabNavigationBar-item @if(request()->routeIs('client.file-manager')) active @endif" href="{{ route('client.file-manager', $client->id ) }}"><i class='bx bx-objects-horizontal-left' ></i> File Manager</a>
        </div>
    </div>
    <livewire:components.add-client @saved="$refresh" />

</div>
