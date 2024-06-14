<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> Webeesocial</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Activities</li>
        </ol>
    </nav>

    <div class="dashboard-head mb-3">
        <div class="row align-items-center">
            <div class="col d-flex align-items-center gap-3">
                <h3 class="main-body-header-title mb-0">All Activities</h3>
                <span class="text-light">|</span>
                @can('Create Client')
                    <a data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#add-activity-modal" href="javascript:void(0);" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i> Add Activities</a>
                @endcan
            </div>
            <div class="col">
                <div class="main-body-header-right">
                    <form class="search-box" action="">
                        <input  type="text" class="form-control" placeholder="Search Company">
                        <button type="submit" class="search-box-icon"><i class='bx bx-search me-1'></i> Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Body -->
    <div class="row mb-2">
        

            @foreach($activities as $activity)
            <div class="col-md-4 mb-4" >
                <div class="card_style card_style-client h-100">
                    <a href="{{ route('client.profile', $activity->id ) }}" class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                    <div class="card_style-head card_style-client-head mb-3">
                        @if($activity->image)
                            <div class="avatar"><img src="{{ asset('storage/'.$activity->image) }}" alt="" class="img-fluid" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $activity->name }}"></div>
                        @else
                            <div class="avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $activity->name }}">{{ $activity->initials }}</div>
                        @endif
                        <div>
                            <h4 class="mb-1">
                                <a wire:navigate href="{{ route('client.profile', $activity->id ) }}">
                                    {{ Str::limit($activity->name, 20, '...') }}
                                </a>
                            </h4>
                            <div class="btn-withIcon"><i class='bx bx-layer text-secondary' ></i> By {{ $activity->createdBy->name }}</div>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="text-md mb-0"><i class="bx bx-user text-primary"></i> Users</h4> 
                        </div>
                        <div class="col">
                            <div class="avatarGroup avatarGroup-overlap">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        
    </div>
    <!-- Pagination -->
    {{-- {{ $activitys->links(data: ['scrollTo' => false]) }} --}}

    <!-- Client Modal Component -->
    <livewire:components.add-activity @saved="$refresh" />
</div>