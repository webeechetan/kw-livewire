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
                {
                    field: "id",
                    headerName: "ID",
                    hide: true,
                    width: 100, 
                    editable: false,
                },
            
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
                    editable: true,
                    width: 600,
                    height: 200,
                    // when edit show big text area
                    cellEditor: 'agTextCellEditor',
                    cellEditorParams: {
                        maxLength: 1000,
                    },
                 },
                {
                    field: "creative_copy",
                    headerName: "Creative Copy",
                    editable: true, // turn off inline editing
                    cellRenderer: function (params) {
                        const copy = params.value;
                        const postId = params.data.id;
                        if (!copy || copy.trim() === "") {
                            return `
                                <div>
                                    <button class="btn btn-sm btn-outline-primary generate-ai-btn" data-id="${postId}" wire:click="regenerateCreativeCopy(${postId})">
                                        <span wire:loading.remove wire:target="regenerateCreativeCopy(${postId})">
                                            <i class="bx bx-bot"></i> Generate with AI
                                        </span>
                                        <span wire:loading wire:target="regenerateCreativeCopy(${postId})">
                                            <i class="bx bx-loader-circle"></i>
                                        </span>
                                    </button>
                                </div>
                            `;
                        }
                        return `<div>
                                    <span>${copy}</span>
                                    <button class="btn btn-sm btn-outline-primary generate-ai-btn" data-id="${postId}">
                                        <i class="bx bx-bot"></i> Regenerate with AI
                                    </button>
                                </div>
                            `;
                    }
                },


                {
                    field: "visual_direction",
                    headerName: "Visual Direction",
                    editable: true,
                    cellRenderer: function (params) {
                        const visual = params.data.visual_direction || '';
                        const postId = params.data.id;
                        if (!visual || visual.trim() === "") {
                            return `
                                <div>
                                    <button class="btn btn-sm btn-outline-primary generate-ai-btn" data-id="${postId}" wire:click="regenerateVisualDirection(${postId})">
                                        <span wire:loading.remove wire:target="regenerateVisualDirection(${postId})">
                                            <i class="bx bx-bot"></i> Generate with AI
                                        </span>
                                        <span wire:loading wire:target="regenerateVisualDirection(${postId})">
                                            <i class="bx bx-loader-circle"></i>
                                        </span>
                                    </button>
                                </div>
                            `;  
                        }
                        return `<div>
                                    <span>${visual}</span>
                                    <button class="btn btn-sm btn-outline-primary generate-ai-btn" data-id="${postId}">
                                        <i class="bx bx-bot"></i> Regenerate with AI
                                        <span wire:loading wire:target="regenerateVisualDirection(${postId})">
                                            <i class="bx bx-loader-circle"></i>
                                        </span>
                                    </button>
                                </div>
                            `;
                    },
                },
                {
                    field: "caption",
                    headerName: "Caption",
                    editable: true,
                    cellRenderer: function (params) {
                        const caption = params.data.caption || '';
                        const postId = params.data.id;
                        if (!caption || caption.trim() === "") {
                            return `
                                <div>
                                    <button class="btn btn-sm btn-outline-primary generate-ai-btn" data-id="${postId}" wire:click="regenerateCaption(${postId})">
                                        <span wire:loading.remove wire:target="regenerateCaption(${postId})">
                                            <i class="bx bx-bot"></i> Generate with AI
                                        </span>
                                        <span wire:loading wire:target="regenerateCaption(${postId})">
                                            <i class="bx bx-loader-circle"></i>
                                        </span>
                                    </button>
                                </div>
                            `;
                        }
                        return `<div>
                                    <span>${caption}</span>
                                    <button class="btn btn-sm btn-outline-primary generate-ai-btn" data-id="${postId}">
                                        <i class="bx bx-bot"></i> Regenerate with AI
                                        <span wire:loading wire:target="regenerateCaption(${postId})">
                                            <i class="bx bx-loader-circle"></i>
                                        </span>
                                    </button>
                                </div>
                            `;
                    },
                },
                {
                    field: "status",
                    headerName: "Status",
                    editable: true,
                    cellEditor: 'agSelectCellEditor',
                    cellEditorParams: {
                        values: [
                            'pending for approval',
                            'pending from client',
                            'approved',
                            'rejected',
                            'published',
                            'scheduled',
                            'archived',
                            'cancelled',
                        ]
                    },
                },
                {
                    field: "actions",
                    headerName: "Actions",
                    cellRenderer: function(params) {
                        // delete post button
                        return '<button class="btn btn-sm btn-outline-danger" wire:click="deletePost(' + params.data.id + ')"><i class="bx bx-trash"></i></button>';
                        // return '<button class="btn btn-primary post-regenerate-btn post-regenerate-btn-' + params.data.id + '" wire:click="regeneratePost(' + params.data.id + ')"><i class="bx bx-refresh" wire:loading.remove wire:target="regeneratePost(' + params.data.id + ')"></i> <i class="bx bx-loader-circle" wire:loading wire:target="regeneratePost(' + params.data.id + ')"></i></button>';
                    },
                }
            ]
        };

        const myGridElement = document.querySelector('#calendarTable');
        var grid = agGrid.createGrid(myGridElement, gridOptions);

        function regeneratePost(id) {
            @this.regeneratePost(id);
        }

        function regenerateCreativeCopy(id) {
            @this.regenerateCreativeCopy(id);
        }

        document.addEventListener('postRegenerated', (event) => {
            var post = event.detail[0];
            console.log(post);
            const rowIndex = calendarData.findIndex(p => p.id === post.id);
            const rowNode = grid.getRowNode(rowIndex);
            rowNode.setDataValue('creative_copy', post.creative_copy);
            rowNode.setDataValue('visual_direction', post.visual_direction);
            rowNode.setDataValue('caption', post.caption);
            
        });

        document.addEventListener('postDeleted', (event) => {
            var postId = event.detail[0];
            const rowIndex = calendarData.findIndex(p => p.id === postId);
            grid.getRowNode(rowIndex).setDataValue('status', 'deleted');
            // remove the row from the grid
            grid.removeRow(rowIndex);
        });

</script>
@endpush
