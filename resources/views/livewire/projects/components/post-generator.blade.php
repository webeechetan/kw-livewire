<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}"><i class='bx bx-line-chart'></i>{{ ucfirst(Auth::user()->organization->name) }}</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
        </ol>
    </nav>
    <livewire:projects.components.project-tabs :project="$project" />
    <div class="row">
            <div class="col-md-4 mb-4 mt-4">
                <div class="card_style card_style-user h-100">
                    <div class="card_style-user-head">
                        <div class="card_style-user-profile-content">
                            <h4>Create Your Post</h4>
                        </div>
                    </div>
                    <div class="card_style-user-body mt-3">
                        <div class="card_style-tasks text-center">
                            <div class="card_style-tasks-title">
                                <div>
                                    <label for="">Content</label>
                                    <textarea wire:model="content" class="form-control" placeholder="Start writing here" rows="8"></textarea>
                                    @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-center align-items-center gap-2 generate-with-ai">
                                        <div class="icon_rounded"><i class="bx bx-bulb"></i></div>
                                        <span>AI Assistant</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button wire:click="createToken" class="btn btn-primary">Create Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-8 mb-4 mt-4">
                <div class="card_style card_style-user h-100">
                    <div class="card_style-user-head">
                        <div class="card_style-user-profile-content">
                            <h4>Tokens</h4>
                        </div>
                    </div>
                    <div class="card_style-user-body mt-3">
                        <div class="card_style-tasks text-center">
                            <div class="card_style-tasks-title">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Token Name</th>
                                            <th>Token Ability</th>
                                            <th>Created Date</th>
                                            <th>Last Used At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- generate-with-ai modal  --}}
            <div class="modal fade" id="generateWithAiModal" tabindex="-1" role="dialog" aria-labelledby="generateWithAiModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="generateWithAiModalLabel">Generate Content</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="form-group"> --}}
                            <label for="aiContent">Prompt</label>
                            <textarea wire:model="prompt" class="form-control" id="prompt" rows="5" placeholder="Enter your prompt here..."></textarea>
                            @error('aiContent') <span class="text-danger">{{ $message }}</span> @enderror
                        {{-- </div> --}}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" wire:click="generatePost">
                        Generate
                        <span wire:loading wire:target="generatePost">
                            <i class='bx bx-loader-alt bx-spin'></i>
                        </span>
                    </button>
                    </div>
                  </div>
                </div>
            </div>
    </div>
</div>
@script
<script>
    $(document).on('click', '.generate-with-ai', function() {
        $('#generateWithAiModal').modal('show');

        document.addEventListener('contentGenerated' , event => {
            console.log(event.detail.message);
            $('#generateWithAiModal').modal('hide');
            // Show success message
        });

    });
</script>
@endscript
