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
                <h4>{{ $contentPlan->title }}</h4>
                <div>
                    <button class="btn btn-primary" id="exportToExcel">Export to Excel</button>
                    <button class="btn btn-primary" id="create-new-post" >Create Post</button>
                    <button class="btn btn-primary" id="import-post-btn" >Import Posts</button>
                    <button class="btn btn-primary add-row-btn" id="add-new-row" >Add Row</button>
                    <div class="import-report mt-3 mb-3 alert alert-info d-none">
                        <div class="summary mb-2"></div>
                        <div class="failures d-none">
                            <button class="btn btn-sm btn-outline-danger mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#importFailureTable">
                                Show Errors
                            </button>
                            <div class="collapse" id="importFailureTable">
                                <table class="table table-sm table-bordered">
                                    <thead class="table-danger">
                                        <tr>
                                            <th>#</th>
                                            <th>Row</th>
                                            <th>Error</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div id="calendarTable" class="mt-4" style="height: 500px"></div>
                </div>
                
            </div> 
        </div>
    </div>
    {{-- generate content plan modal --}}
    <div class="modal fade" id="generateWithAIModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="btn-icon btn-icon-primary me-1"><i
                                class='bx bx-layer'></i></span> Generate <span id="generateWithAIModalTitle"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-form-body">
                    <div class="mb-4">
                        <label for="title" class="form-label">Title</label>
                        <textarea name="generateWithAIColumn" cols="30" rows="10" class="form-style generateWithAIColumn" 
                            placeholder="Enter a descriptive title for your content plan"></textarea>
                    </div>
                    <span class="d-none">
                        <input type="text" name="generateWithAIColumnName" class="generateWithAIColumnName">
                        <input type="text" name="generateWithAIColumnId" class="generateWithAIColumnId">
                    </span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary generateContentPlanBtn">
                        Generate With AI
                    </button>
                    <button class="btn btn-primary apply-post-btn" data-bs-dismiss="modal">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- create post modal --}}
    <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="btn-icon btn-icon-primary me-1"><i
                                class='bx bx-layer'></i></span>Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-form-body">
                    <div class="mb-4">
                        <label for="post-date" class="form-label">Post Date</label>
                        <input type="date" class="form-style" wire:model="post_date" id="post_date" placeholder="Select start date">
                    </div>
                    <div class="mb-4">
                        <label for="platforms" class="form-label">Platforms</label>
                        <input type="text" class="form-style" wire:model="platforms" id="platforms"
                            placeholder="Enter platforms (e.g., Instagram, Facebook, Twitter)">
                    </div>
                    <div class="mb-4">
                        <label for="format" class="form-label">Format</label>
                        <input type="text" class="form-style" wire:model="format" id="format" 
                            placeholder="Reel,Post,Short Video">
                    </div>
                    <div class="mb-4">
                        <label for="content_bucket" class="form-label">Content Bucket</label>
                        <input type="text" class="form-style" wire:model="content_bucket" id="content_bucket"
                            placeholder="Testimonial, Behind the scene">
                    </div>
                    <div class="mb-4">
                        <label for="content_idea" class="form-label">Content Idea</label>
                        <textarea type="text" class="form-style" wire:model="content_idea" id="content_idea"
                            placeholder=""></textarea>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button wire:click="createPost" class="btn btn-primary createPostBtn">
                        <span wire:loading.remove wire:target="createPost">
                            Create Post
                        </span>
                        <span wire:loading wire:target="createPost">
                            Creating...
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Import Post Modal  --}}
    <div class="modal fade" id="importPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" wire:ignore>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                <h5 class="modal-title" id="exampleModalLabel">
                    <span class="btn-icon btn-icon-primary me-1">
                        <i class='bx bx-layer'></i>
                    </span>Import Post
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body modal-form-body">
                <div class="mb-3 p-3 border rounded bg-light">
                    <h6 class="mb-2">📝 Import Instructions</h6>
                    <ul class="mb-2">
                        <li>Upload a CSV or Excel file with the correct headers.</li>
                        <li>Ensure dates are in <code>YYYY-MM-DD</code> format.</li>
                        <li>Maximum 1000 rows per file.</li>
                    </ul>
                    <div class="mb-2">
                        <strong>Required Headers:</strong>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-center">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>date</th>
                                        <th>platform</th>
                                        <th>format</th>
                                        <th>content_bucket</th>
                                        <th>content_idea</th>
                                        <th>creative_copy</th>
                                        <th>visual_direction</th>
                                        <th>caption</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div>
                        <a href="/path-to-sample-template.xlsx" class="btn btn-link btn-sm" target="_blank">
                            <i class="bx bx-download"></i> Download Sample Template
                        </a>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="post-date" class="form-label">Select File</label>
                    <input type="file" class="form-style" wire:model="postFile" id="postFile">
                </div>
            </div>

            <div class="modal-footer">
                <button wire:click="importPost" class="btn btn-primary importPostBtn">
                    <span wire:loading.remove wire:target="importPost, postFile">
                        Import Posts
                    </span>
                    <span wire:loading wire:target="importPost, postFile">
                        Loading...
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

    document.addEventListener('imported', (event) => {
        $("#importPostModal").modal('hide');
        console.log(event.detail)
        const report = event.detail[0];
        const container = document.querySelector('.import-report');
        const summary = container.querySelector('.summary');
        const failureSection = container.querySelector('.failures');
        const failureBody = container.querySelector('tbody');

        // Reset old content
        summary.innerHTML = '';
        failureBody.innerHTML = '';
        failureSection.classList.add('d-none');

        if(report.header_error == '' || report.header_error == null){
            // Show summary
            summary.innerHTML = `
                <strong>Import Summary:</strong><br>
                <strong>Success</strong> : ${report.success || 0} rows imported successfully<br>
                <strong>Failed </strong>: ${report.failed || 0} failed
            `;
        } else{
            summary.innerHTML = `
                <strong>Import Summary:</strong><br>
                <strong>Header Error</strong> : ${report.header_error || 0}
                `;
        }


        // Show failures if any
        if (report.failed && report.failures && report.failures.length > 0) {
            failureSection.classList.remove('d-none');

            report.failures.forEach((item, index) => {
                failureBody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td><pre>${JSON.stringify(item.row, null, 2)}</pre></td>
                        <td>${item.error}</td>
                    </tr>
                `;
            });
        }

        // Show the report
        container.classList.remove('d-none');
    });


    $(document).ready(function(){
        $("#create-new-post").click(function(){
            $("#createPostModal").modal('show')
        });
        
        $("#import-post-btn").click(function(){
            $("#importPostModal").modal('show')
        });
    });

        let postData = @json($contentPlan->posts);
        let calendarTable = document.getElementById('calendarTable');
        
        const gridOptions = {
        // Row Data: The data to be displayed.
        rowData: postData,
        // export data to excel
        // row height
        rowHeight: 100,


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
                    filter: true,
                    editable: true,
                    filterParams: {
                        filterOptions: ['contains', 'equals', 'notEqual', 'lessThan', 'lessThanOrEqual', 'greaterThan', 'greaterThanOrEqual', 'inRange', 'notInRange', 'startsWith', 'endsWith', 'isEmpty', 'isNotEmpty'],
                    },
                    onCellValueChanged : function(params){
                        const updatedValue = params.newValue;
                        const rowId = params.data.id;
                        @this.saveColumnValue(rowId,'date',updatedValue)
                    }
                 },
                { field: "platform",
                    headerName: "Platform",
                    filter: true,
                    editable: true,
                    onCellValueChanged : function(params){
                        const updatedValue = params.newValue;
                        const rowId = params.data.id;
                        @this.saveColumnValue(rowId,'platform',updatedValue)
                    }
                 },
                { field: "format", 
                    headerName: "Format",
                    filter: true,
                    editable: true,
                    onCellValueChanged : function(params){
                        const updatedValue = params.newValue;
                        const rowId = params.data.id;
                        @this.saveColumnValue(rowId,'format',updatedValue)
                    }
                 },
                { 
                    field: "content_bucket",
                    headerName: "Content Bucket",
                    editable: true,
                    onCellValueChanged : function(params){
                        const updatedValue = params.newValue;
                        const rowId = params.data.id;
                        @this.saveColumnValue(rowId,'content_bucket',updatedValue)
                    }
                    
                 },
                 { 
                    field: "content_idea",
                    headerName: "Content Idea",
                    editable: true,
                    width: 600,
                    height: 100,
                    // when edit show big text area
                    cellEditor: 'agTextCellEditor',
                    cellEditorParams: {
                        maxLength: 1000,
                    },
                    // text wrap
                    wrapText: true,
                    onCellValueChanged : function(params){
                        const updatedValue = params.newValue;
                        const rowId = params.data.id;
                        @this.saveColumnValue(rowId,'content_idea',updatedValue)
                    }
                 },
                {
                    field: "creative_copy",
                    headerName: "Creative Copy",
                    editable: true,
                    onCellClicked: function(params) {
                        // open generate with ai modal
                        $('.generateWithAIColumnName').val('creative_copy');
                        $('#generateWithAIModal').modal('show');
                        $('#generateWithAIModalTitle').text('Creative Copy');
                        $('.generateWithAIColumn').val(params.data.creative_copy);
                        $('.generateWithAIColumnId').val(params.data.id);
                        $('.generateWithAIColumn').focus();
                    },
                    wrapText: true,
                },


                {
                    field: "visual_direction",
                    headerName: "Visual Direction",
                    editable: true,
                    onCellClicked: function(params) {
                        $('.generateWithAIColumnName').val('visual_direction');
                        $('#generateWithAIModal').modal('show');
                        $('#generateWithAIModalTitle').text('Visual Direction');
                        $('.generateWithAIColumn').val(params.data.visual_direction);
                        $('.generateWithAIColumnId').val(params.data.id);
                        $('.generateWithAIColumn').focus();
                    },
                    wrapText: true,
                },
                {
                    field: "caption",
                    headerName: "Caption",
                    editable: true,
                    onCellClicked: function(params) {
                        $('.generateWithAIColumnName').val('caption');
                        $('#generateWithAIModal').modal('show');
                        $('#generateWithAIModalTitle').text('Caption');
                        $('.generateWithAIColumn').val(params.data.caption);
                        $('.generateWithAIColumnId').val(params.data.id);
                        $('.generateWithAIColumn').focus();
                    },
                    wrapText: true,
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
                    filter: true,
                    filterParams: {
                        filterOptions: ['contains'],
                    },
                    onCellValueChanged : function(params){
                        const updatedValue = params.newValue;
                        const rowId = params.data.id;
                        @this.saveColumnValue(rowId,'status',updatedValue)
                    }
                },
                {
                    field: "assigned_to",
                    headerName: "Assigned To",
                    editable: true,
                    cellEditor: MultiSelectCellEditor,
                    cellEditorParams: {
                        values: Object.entries(@json($users)), // [[id, name], ...]
                    },
                    filter: true,
                    filterParams: {
                        filterOptions: ['contains'],
                    },
                    valueFormatter: function(params) {
                        // params.value is expected to be an object: {user_id: user_name, ...}
                        if (!params.value) return '';
                        if (Array.isArray(params.value)) {
                            // fallback: array of ids
                            return params.value.map(id => (@json($users)[id] || id)).join(', ');
                        }
                        // object: user_id => user_name
                        return Object.values(params.value).join(', ');
                    },
                    onCellValueChanged: function(params) {
                        console.log(params);
                    }
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

        // Set the row data
        $("#add-new-row").click(function() {
            // Add a new row to the grid
            if (!grid) {
                console.error("Grid is not initialized.");
                return;
            }
            @this.createBlankPost();

        });
        

        // export to excel
        $('#exportToExcel').click(function() {
            var data = grid.getDataAsCsv();
            var blob = new Blob([data], { type: 'text/csv' });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'content-plan.csv';
            a.click();
        });

        function regeneratePost(id) {
            @this.regeneratePost(id);
        }

        function regenerateCreativeCopy(id) {
            @this.regenerateCreativeCopy(id);
        }

        document.addEventListener('postRegenerated', (event) => {
            console.log(event.detail);
            var columnValue = event.detail;
            $(".generateWithAIColumn").val(columnValue);
            
        });

        document.addEventListener('postDeleted', (event) => {
            var postId = event.detail[0];
            const rowIndex = postData.findIndex(p => p.id === postId);
            grid.getRowNode(rowIndex).setDataValue('status', 'deleted');
            grid.getRowNode(rowIndex).setDataValue('content_idea', 'deleted');
            grid.getRowNode(rowIndex).setDataValue('creative_copy', 'deleted');
            grid.getRowNode(rowIndex).setDataValue('visual_direction', 'deleted');
            grid.getRowNode(rowIndex).setDataValue('caption', 'deleted');
            grid.getRowNode(rowIndex).setDataValue('date', 'deleted');
            grid.getRowNode(rowIndex).setDataValue('platform', 'deleted');
            grid.getRowNode(rowIndex).setDataValue('format', 'deleted');
            grid.getRowNode(rowIndex).setDataValue('content_bucket', 'deleted');
            grid.getRowNode(rowIndex).setDataValue('id', 'deleted');
            // add d-none class to the row
            // grid.getRowNode(rowIndex).rowClass = 'd-none';
            grid.getRowNode(rowIndex).setRowClass('d-none');

        });


        document.addEventListener('postApplied', (event) => {
            var post = event.detail[0];
            const rowIndex = postData.findIndex(p => p.id === post.id);
            grid.getRowNode(rowIndex).setDataValue('creative_copy', post.creative_copy);
            grid.getRowNode(rowIndex).setDataValue('visual_direction', post.visual_direction);
            grid.getRowNode(rowIndex).setDataValue('caption', post.caption);
        });

        document.addEventListener('post-created',(event)=>{
            var post = event.detail[0];
            $("#createPostModal").modal('hide');

        });

        document.addEventListener('blank-post-created', (event)=>{
           var post = event.detail[0];
             const newRow = {
                id: post.id, // Unique ID for the new row
                date: '',
                platform: '',
                format: '',
                content_bucket: '',
                content_idea: '',
                creative_copy: '',
                visual_direction: '',
                caption: '',
                status: 'pending',
                assigned_to: {}
            };

            grid.applyTransaction({ add: [newRow] });
        });

        $('.generateContentPlanBtn').click(function() {
            var columnName = $('.generateWithAIColumnName').val();
            var columnValue = $('.generateWithAIColumn').val();
            var columnId = $('.generateWithAIColumnId').val();
            @this.generateColumnValue(columnName, columnValue, columnId);
        });

        $('.apply-post-btn').click(function() {
            var columnName = $('.generateWithAIColumnName').val();
            var columnValue = $('.generateWithAIColumn').val();
            var columnId = $('.generateWithAIColumnId').val();
            console.log(columnName, columnValue, columnId);
            @this.applyColumnValue(columnName, columnValue, columnId);
        });

        // Custom MultiSelect Cell Editor for ag-Grid
        function MultiSelectCellEditor() {}

        MultiSelectCellEditor.prototype.init = function(params) {
            this.container = document.createElement('div');
            this.select = document.createElement('select');
            this.select.multiple = true;
            this.select.style.width = '100%';
            this.select.style.height = '80px';

            // params.values: [[id, name], ...]
            let selectedIds = [];
            if (params.value && typeof params.value === 'object' && !Array.isArray(params.value)) {
                selectedIds = Object.keys(params.value);
            } else if (Array.isArray(params.value)) {
                selectedIds = params.value;
            }

            params.values.forEach(([id, name]) => {
                const option = document.createElement('option');
                option.value = id;
                option.text = name;
                if (selectedIds.includes(String(id))) {
                    option.selected = true;
                }
                this.select.appendChild(option);
            });

            this.container.appendChild(this.select);
        };

        MultiSelectCellEditor.prototype.getGui = function() {
            return this.container;
        };

        MultiSelectCellEditor.prototype.afterGuiAttached = function() {
            this.select.focus();
        };

        MultiSelectCellEditor.prototype.getValue = function() {
            // Return object: {user_id: user_name, ...}
            const selected = Array.from(this.select.selectedOptions).map(opt => [opt.value, opt.text]);
            const obj = {};
            selected.forEach(([id, name]) => { obj[id] = name; });
            return obj;
        };

        MultiSelectCellEditor.prototype.destroy = function() {};
        MultiSelectCellEditor.prototype.isPopup = function() {
            return false;
        };

</script>
@endpush
