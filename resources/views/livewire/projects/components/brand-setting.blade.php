<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}"><i class='bx bx-line-chart'></i>{{ ucfirst(Auth::user()->organization->name) }}</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
        </ol>
    </nav>

    <livewire:projects.components.project-tabs :project="$project" />

    {{-- content calander table --}}
    <div wire:ignore>
        <div class="row calendarTableRow d-none">
            <div class="col-md-12 mb-4">
                {{-- <div class="card_style card_style-user h-100">
                    <div class="card_style-user-head">
                        <div class="card_style-user-profile-content"> --}}
                            <h4>Content Calendar Table</h4>
                            <div>
                                <div id="calendarTable" class="mt-4" style="height: 500px"></div>
                            </div>
                        {{-- </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card_style card_style-user h-100">
                <div class="card_style-user-head">
                    <div class="card_style-user-profile-content">
                        <h4>Create New</h4>
                        {{-- generate button --}}
                        <div class="d-flex text-center">
                            <button class="btn btn-primary generateContentCalendarBtn" data-bs-toggle="modal" data-bs-target="#contentPlanModal">
                                <span>
                                    Generate Content Calendar
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach($contentPlans as $contentPlan)
        <div class="col-md-4 mb-4">
            <div class="card_style card_style-user h-100">
                <div class="card_style-user-head">
                    <div class="card_style-user-profile-content">
                        <a href="{{ route('project.content-plan', [$project->id, $contentPlan->id]) }}">
                            <h4>{{ $contentPlan->title ?? 'Untitled'}}</h4>
                        </a>
                        {{-- generate button --}}
                        <div class="d-flex ">
                            {{-- status --}}
                            Status: <span class="badge bg-primary">
                                {{ $contentPlan->status }} 
                            </span>
                            {{-- duration --}}
                            Duration: <span class="badge bg-primary">
                                {{ $contentPlan->duration }}
                            </span> 
                            {{-- number of posts --}}
                            Number of Posts: <span class="badge bg-primary">
                                {{ $contentPlan->number_of_posts }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    

    {{-- content plan modal --}}

    <div class="modal fade" id="contentPlanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Contant Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- title --}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" wire:model="title" id="title" placeholder="Enter title">
                </div>
                {{-- duration --}}
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="text" class="form-control" wire:model="duration" id="duration" placeholder="Enter duration">
                </div>
                {{-- Goals --}}
                <div class="form-group">
                    <label for="goals">Goals</label>
                    <input type="text" class="form-control" wire:model="goals" id="goals" placeholder="Enter goals">
                </div>
                {{-- Number of posts --}}
                <div class="form-group">
                    <label for="number_of_posts">Number of posts</label>
                    <input type="text" class="form-control" wire:model="number_of_posts" id="number_of_posts" placeholder="Enter number of posts">
                </div>
                {{-- platforms --}}
                <div class="form-group">
                    <label for="platforms">Platforms</label>
                    <input type="text" class="form-control" wire:model="platforms" id="platforms" placeholder="Enter platforms">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click="generateContentCalendar" class="btn btn-primary generateContentCalendarBtn">
                    <span wire:loading.remove wire:target="generateContentCalendar">
                        Generate Content Calendar
                    </span>
                    <span wire:loading wire:target="generateContentCalendar">
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

    $(".generateContentCalendarBtn").click(function(){
        // show modal
        $('#contentPlanModal').modal('show');
    });

    document.addEventListener('showContentCalendar', (event) => {

        // document.querySelector('#calendarTable').classList.remove('d-none');
        

        let calendarData = event.detail[0];
        let calendarTable = document.getElementById('calendarTable');
        
        const gridOptions = {
        // Row Data: The data to be displayed.
        rowData: calendarData,
        // Column Definitions: Defines the columns to be displayed.
        columnDefs: [
                {
                    field: "week",
                },
                { field: "date" },
                { field: "platform" },
                { field: "format" },
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
