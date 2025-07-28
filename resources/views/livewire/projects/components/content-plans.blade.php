<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}"><i
                        class='bx bx-line-chart'></i>{{ ucfirst(Auth::user()->organization->name) }}</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
        </ol>
    </nav>

    <livewire:projects.components.project-tabs :project="$project" />

    @if(!$project->brief)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <h4>No brief found</h4>
                    <p>Please create a brief for the project before generating a content plan.</p>
                    <a href="{{ route('project.brief', $project->id) }}" class="btn btn-primary">Create Brief</a>
                </div>
            </div>
        </div>
    @endif

    {{-- content calander table --}}
    <div wire:ignore>
        <div class="row calendarTableRow d-none">
            <div class="col-md-12 mb-4">
                <h4>Content Plan Table</h4>
                <div>
                    <div id="calendarTable" class="mt-4" style="height: 500px"></div>
                </div>
            </div>
        </div>
    </div>

    @if($project->brief)
    <div class="row mt-4">
        <div class="col">
            <div class="column-box">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="column-title mb-0">Content Plan</h4>
                    <div class="d-flex text-center gap-2">
                        <button class="btn-border btn-sm btn-border-primary" data-bs-toggle="modal"
                            data-bs-target="#contentPlanModal">
                            <i class="bx bx-plus"></i> Generate Content Plan
                        </button>
                    </div>
                </div>

                <hr class="space-sm">

                <div class="row">
                    {{-- @foreach ($contentPlans as $contentPlan)
                        <div class="col-md-4 mb-4">
                            <div class="card_style card_style-user h-100">
                                <div class="card_style-user-head">
                                    <div class="card_style-user-profile-content">
                                        <a href="{{ route('project.content-plan', [$project->id, $contentPlan->id]) }}">
                                            <h4>{{ $contentPlan->title ?? 'Untitled' }}</h4>
                                        </a>
                                        <div class="d-flex ">
                                            Status: <span class="badge bg-primary ms-1 me-2">
                                                {{ $contentPlan->status }}
                                            </span>
                                            Duration: <span class="badge bg-primary ms-1 me-2">
                                                {{ $contentPlan->duration }}
                                            </span>
                                            Number of Posts: <span class="badge bg-primary ms-1">
                                                {{ $contentPlan->number_of_posts }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>
    @endif

    <div>
        <div class="row mt-4">
            @foreach ($contentPlans as $plan)
                <div class="col-md-4 mb-4">
                    <div class="card_style h-100">
                        <a href="{{ route('project.content-plan', [$project->id, $plan->id]) }}"
                            class="card_style-open"><i class='bx bx-chevron-right'></i></a>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-light text-dark">{{ $plan->status }}</span>
                            </div>
                            <div class="card_style-project-head">
                                <h4>
                                    <a href="{{ route('project.content-plan', [$project->id, $plan->id]) }}">
                                        {{ $plan->title }}
                                    </a>
                                </h4>
                            </div>
                            <div class="d-flex align-items-center text-muted small mb-1">
                                <i class='bx bx-calendar me-1'></i>
                                {{ \Carbon\Carbon::parse($plan->start_date)->format('d M') }} -
                                {{ \Carbon\Carbon::parse($plan->end_date)->format('d M') }}
                            </div>
                            <div class="d-flex align-items-center text-muted small">
                                <i class='bx bx-layer me-1'></i>
                                {{ $plan->number_of_posts }} Posts
                            </div>
                            <div class="d-flex align-items-center text-muted small">
                                <i class='bx bx-layer me-1'></i>
                                {{ $plan->platforms }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    {{-- content plan modal --}}
    <div class="modal fade" id="contentPlanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="btn-icon btn-icon-primary me-1"><i
                                class='bx bx-layer'></i></span> Generate Content Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-form-body">
                    <div class="mb-4">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-style" wire:model="title" id="title"
                            placeholder="Enter a descriptive title for your content plan">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-style" wire:model="description" id="description" rows="3"
                            placeholder="Describe the main focus, theme, or objective of this content plan"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-style" wire:model="start_date" id="start_date"
                            placeholder="Select start date">
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-style" wire:model="end_date" id="end_date"
                            placeholder="Select end date">
                    </div>
                    <div class="mb-4">
                        <label for="number_of_posts" class="form-label">Number of Posts</label>
                        <input type="text" class="form-style" wire:model="number_of_posts" id="number_of_posts"
                            placeholder="Enter number of posts">
                    </div>
                    <div class="mb-4">
                        <label for="platforms" class="form-label">Platforms</label>
                        <input type="text" class="form-style" wire:model="platforms" id="platforms"
                            placeholder="Enter platforms (e.g., Instagram, Facebook, Twitter)">
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button wire:click="generateContentPlan" class="btn btn-primary generateContentPlanBtn">
                        <span wire:loading.remove wire:target="generateContentPlan">
                            Generate Content Plan
                        </span>
                        <span wire:loading wire:target="generateContentPlan">
                            Generating...
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </span>
                    </button> --}}
                    <button wire:click="generateContentPlan" class="btn btn-primary generateContentPlanBtn">
                        <span wire:loading.remove wire:target="generateContentPlan">
                            Generate Content Plan
                        </span>
                        <span wire:loading wire:target="generateContentPlan">
                            Generating...
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@assets
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endassets

@php
    $events = [];
    foreach ($contentPlans as $contentPlan) {
        $events[] = [
            'title' => $contentPlan->title,
            'start' => $contentPlan->start_date,
            'end' => $contentPlan->end_date,
        ];
    }
@endphp


@push('scripts')
    <script>
        $(".generateContentPlanBtn").click(function() {
            // show modal
            $('#contentPlanModal').modal('show');

            // calendar
        });
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: @json($events),
                dayMaxEventRows: true,
                moreLinkClick: 'popover',
                moreLinkClassNames: 'calendar-more-link-btn',
                // initialView: 'dayGridMonth',
                views: {
                    dayGridMonth: {
                        titleFormat: {
                            month: 'long',
                        }
                    }
                }
            });
            calendar.render();
        });
    </script>
@endpush
