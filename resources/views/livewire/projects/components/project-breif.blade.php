<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}"><i class='bx bx-line-chart'></i>{{ ucfirst(Auth::user()->organization->name) }}</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('project.index') }}">All Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
        </ol>
    </nav>

    <livewire:projects.components.project-tabs :project="$project" />

    <div class="row mt-4">
        {{-- brand details --}}
        <div class="col-md-12 mb-4">
            <div class="card_style card_style-user h-100">
                <div class="card_style-user-head">
                    <div class="card_style-user-profile-content">
                        <h4>Add Project Brief</h4>
                    </div>
                    {{-- create brand form --}}
                    <div class="card_style-user-body">
                        <div class="card_style-user-body-content">
                            <form wire:submit.prevent="saveProjectBreif" class="row g-3">
                                <div class="col-md-12 mt-4">
                                    <label for="brandDescription" class="form-label">Brand Description</label>
                                    <input type="text" wire:model="brandDescription" class="form-control" id="brandDescription" >
                                    @error('brandDescription') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>


                                <div class="col-md-12 mt-4">
                                    <label for="brandGoals" class="form-label">Add Monthly / Quarterly Goals</label>
                                    <input type="text" wire:model="brandGoals" class="form-control" id="brandGoals" value="">
                                    @error('brandGoals') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-12 mt-4">
                                    <label for="brnadObjective" class="form-label">Add Long-term Objectives</label>
                                    <input type="text" wire:model="brandObjective" class="form-control" id="brnadObjective" value="">
                                    @error('brandObjective') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-12 mt-4">
                                    <label for="campaignTimelines" class="form-label">Key Campaign Timelines</label>
                                    <input type="text" wire:model="campaignTimelines" class="form-control" id="campaignTimelines" value="">
                                    @error('campaignTimelines') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-12 mt-4">
                                    <label for="brandVoice" class="form-label">What is your brand voice?</label>
                                    <input type="text" wire:model="brandVoice" class="form-control" id="brandVoice" value="">
                                    @error('brandVoice') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-12 mt-4">
                                    <label for="avoidWords" class="form-label">What topics should you never talk about?</label>
                                    <input type="text" wire:model="avoidWords" class="form-control" id="avoidWords" value="">
                                    @error('avoidWords') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-12 mt-4">
                                    <label for="competitors" class="form-label">List 3 competitors and your differentiator (USP)</label>
                                    <input type="text" wire:model="competitors" class="form-control" id="competitors" value="">
                                    @error('competitors') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-12 mt-4">
                                    <label for="platforms" class="form-label">What platforms are most important to your brand?</label>
                                    <input type="text" wire:model="platforms" class="form-control" id="platforms" value="">
                                    @error('platforms') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

