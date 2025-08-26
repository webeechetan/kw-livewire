<div class="cus_dropdown" wire:ignore.self>
    <div class="cus_dropdown-icon btn-border btn-border-secondary"><i class='bx bx-filter-alt' ></i> Filter</div>
    <div class="cus_dropdown-body cus_dropdown-body-widh_l">
        <div class="cus_dropdown-body-wrap">
            <div class="filterSort">
                <h5 class="filterSort-header"><i class='bx bx-sort-down text-primary' ></i> Sort By</h5>
                <ul class="filterSort_btn_group list-none">
                    <li class="filterSort_item">
                        <a wire:click="$set('sort', 'newest')" class="btn-batch @if($sort == 'newest') active @endif ">Newest</a>
                    </li>
                    <li class="filterSort_item">
                        <a wire:click="$set('sort', 'oldest')" class="btn-batch @if($sort == 'oldest') active @endif " >Oldest</a>
                    </li>
                    <li class="filterSort_item">
                        <a wire:click="$set('sort', 'a_z')" class="btn-batch @if($sort == 'a_z') active @endif"><i class='bx bx-down-arrow-alt' ></i> A To Z</a>
                    </li>
                    <li class="filterSort_item">
                        <a wire:click="$set('sort', 'z_a')" class="btn-batch @if($sort == 'z_a') active @endif"><i class='bx bx-up-arrow-alt' ></i> Z To A</a>
                    </li>
                </ul>
                <h5 class="filterSort-header mt-4"><i class='bx bx-calendar-alt text-primary' ></i> Filter By Date</h5>
                <div class="row align-items-center mt-2">
                    <div class="col mb-4 mb-md-0" wire:ignore>
                        <a href="javascript:;" class="btn w-100 btn-sm btn-border-secondary start_date">
                            @if($startDate)
                                {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}
                            @else
                                <i class='bx bx-calendar-alt' ></i> Start Date
                            @endif
                        </a>
                    </div>
                    <div class="col-auto text-center font-500 mb-4 mb-md-0 px-0">
                        To
                    </div>
                    <div class="col" wire:ignore>
                        <a href="javascript:;" class="btn w-100 btn-sm btn-border-danger due_date">
                            @if($dueDate)
                                {{ \Carbon\Carbon::parse($dueDate)->format('d M Y') }}
                            @else
                                <i class='bx bx-calendar-alt' ></i> Due Date
                            @endif
                        </a>
                    </div>
                </div> 
                <h5 class="filterSort-header mt-4"><i class='bx bx-calendar-alt text-primary' ></i> Filter By Status</h5>
                <ul class="filterSort_btn_group list-none">
                    <li class="filterSort_item"><a wire:click="$set('status', 'all')" class="btn-batch @if($status == 'all') active @endif">All</a></li>
                    <li class="filterSort_item"><a wire:click="$set('status', 'pending')" class="btn-batch @if($status == 'pending') active @endif">Assigned</a></li>
                    <li class="filterSort_item"><a wire:click="$set('status', 'in_progress')" class="btn-batch @if($status == 'in_progress') active @endif">Accepted</a></li>
                    <li class="filterSort_item"><a wire:click="$set('status', 'in_review')" class="btn-batch @if($status == 'in_review') active @endif">In Review</a></li>
                    <li class="filterSort_item"><a wire:click="$set('status', 'overdue')" class="btn-batch @if($status == 'overdue') active @endif">Overdue</a></li>
                    <li class="filterSort_item"><a wire:click="$set('status', 'completed')" class="btn-batch @if($status == 'completed') active @endif">Completed</a></li>
                </ul>
                
                <h5 class="filterSort-header mt-4"><i class='bx bx-briefcase text-primary' ></i> Filter By Clients</h5>
                <select class="dashboard_filters-select w-100" wire:model.live="byClient" id="">
                    <option value="all">Select Client</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
                </select>
                <h5 class="filterSort-header mt-4"><i class='bx bx-objects-horizontal-left text-primary'></i> Filter By Projects</h5>
                <select class="dashboard_filters-select w-100" wire:model.live="byProject" id="">
                    <option value="all">All</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                <h5 class="filterSort-header mt-4"><i class='bx bx-user text-primary'></i> Filter By User</h5>
                <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byUser" id="">
                    <option value="all">Select User</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>

                {{-- <h5 class="filterSort-header mt-4"><i class='bx bx-user text-primary'></i> Filter By Team</h5>
                <select class="dashboard_filters-select mt-2 w-100" wire:model.live="byTeam" id="">
                    <option value="all">Select Team</option>
                    @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select> --}}
            </div>
        </div>
    </div>
</div>