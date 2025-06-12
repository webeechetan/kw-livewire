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


    <div class="row mt-4">
        <div class="col-md-12 mb-4">
            <div class="column-box">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4>Content Plan</h4>
                    <div class="d-flex text-center">
                        <button class="btn btn-primary generateContentPlanBtn" data-bs-toggle="modal"
                            data-bs-target="#contentPlanModal">
                            <span>
                                Generate Content Plan
                            </span>
                        </button>
                    </div>
                </div>

                <hr class="space-sm">

                <div class="row">
                    @foreach ($contentPlans as $contentPlan)
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
                    @endforeach
                </div>
            </div>
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
                    <form>
                        <div class="mb-4">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-style" wire:model="title" id="title"
                                placeholder="Enter title">
                        </div>
                        <div class="mb-4">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-style" wire:model="duration" id="duration"
                                placeholder="Enter duration">
                        </div>
                        <div class="mb-4">
                            <label for="goals" class="form-label">Goals</label>
                            <input type="text" class="form-style" wire:model="goals" id="goals"
                                placeholder="Enter goals">
                        </div>
                        <div class="mb-4">
                            <label for="number_of_posts" class="form-label">Number of posts</label>
                            <input type="text" class="form-style" wire:model="number_of_posts" id="number_of_posts"
                                placeholder="Enter number of posts">
                        </div>
                        <div class="mb-4">
                            <label for="platforms" class="form-label">Platforms</label>
                            <input type="text" class="form-style" wire:model="platforms" id="platforms"
                                placeholder="Enter platforms">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
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
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
@endassets

@push('scripts')
    <script>
        $(".generateContentPlanBtn").click(function() {
            // show modal
            $('#contentPlanModal').modal('show');
        });

        document.addEventListener('showContentPlan', (event) => {

            // document.querySelector('#calendarTable').classList.remove('d-none');


            let calendarData = event.detail[0];
            let calendarTable = document.getElementById('calendarTable');

            const gridOptions = {
                // Row Data: The data to be displayed.
                rowData: calendarData,
                // Column Definitions: Defines the columns to be displayed.
                columnDefs: [{
                        field: "week",
                    },
                    {
                        field: "date"
                    },
                    {
                        field: "platform"
                    },
                    {
                        field: "format"
                    },
                    {
                        field: "content_bucket",
                        headerName: "Content Bucket",

                    },
                    {
                        field: "content_idea",
                        headerName: "Content Idea",

                    },
                    {
                        field: "title",
                        editable: true,
                    },
                    {
                        field: "post",
                        editable: true,
                    },
                    {
                        field: "status",
                        cellEditor: 'agSelectCellEditor',
                        cellEditorParams: {
                            values: ['Scheduled', 'Posted', 'Draft']
                        },
                        editable: true,
                    },
                ]
            };

            const myGridElement = document.querySelector('#calendarTable');
            agGrid.createGrid(myGridElement, gridOptions);

            $('#contentPlanModal').modal('hide');

            $(".calendarTableRow").removeClass('d-none');
            // $(".calendarTableRow").show();
            // $(".calendarTableRow").addClass('abcbcbcbb');

            // console.log($(".calendarTableRow"));

        });
    </script>
@endpush
