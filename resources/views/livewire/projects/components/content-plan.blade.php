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
        <div class="row calendarTableRow ">
            <div class="col-md-12 mb-4">
                            <h4>Content Plan Table</h4>
                            <div>
                                <div id="calendarTable" class="mt-4" style="height: 500px"></div>
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

        let calendarData = @json($contentPlan->posts);
        let calendarTable = document.getElementById('calendarTable');
        
        const gridOptions = {
        // Row Data: The data to be displayed.
        rowData: calendarData,
        // Column Definitions: Defines the columns to be displayed.
        columnDefs: [
                { field: "date",
                    headerName: "Date",
                 },
                { field: "platform",
                    headerName: "Platform",
                 },
                { field: "format",
                    headerName: "Format",
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
                    field: "description",
                    headerName: "Description",
                    editable: true,
                    // when edit show big text area
                    cellEditor: 'agTextCellEditor',
                    cellEditorParams: {
                        maxLength: 1000,
                    },
                },
                { 
                    field: "status",
                    cellEditor: 'agSelectCellEditor',
                    cellEditorParams: {
                        values: ['Scheduled', 'Posted', 'Draft']
                    },
                    editable: true,
                },
                {
                    field: "actions",
                    headerName: "Actions",
                    cellRenderer: function(params) {
                        // regenerate post button
                        return '<button class="btn btn-primary post-regenerate-btn post-regenerate-btn-' + params.data.id + '" wire:click="regeneratePost(' + params.data.id + ')"><i class="bx bx-refresh" wire:loading.remove wire:target="regeneratePost(' + params.data.id + ')"></i> <i class="bx bx-loader-circle" wire:loading wire:target="regeneratePost(' + params.data.id + ')"></i></button>';
                    },
                }
            ]
        };

        const myGridElement = document.querySelector('#calendarTable');
        agGrid.createGrid(myGridElement, gridOptions);

        function regeneratePost(id) {
            @this.regeneratePost(id);
        }

        // document.addEventListener('postRegenerated', (event) => {
        //     // show regenerated post
        // });

        document.addEventListener('livewire:load', () => {
            Livewire.on('postRegenerated', (updatedPost) => {
                const rowNode = gridOptions.api.getRowNode(updatedPost.id);
                if (rowNode) {
                    rowNode.setData(updatedPost);
                    gridOptions.api.flashCells({ rowNodes: [rowNode] });
                }
            });
        });

</script>
@endpush
