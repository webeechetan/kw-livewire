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

    <div class="row mt-4">
        {{-- brand details --}}
        <div class="col-md-12 mb-4">
            <div class="column-box">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="card_style-user-profile-content">
                        <h4>Add Project Brief</h4>
                    </div>
                </div>
                <hr class="space-sm">
                {{-- create brand form --}}
                <form wire:submit.prevent="saveProjectBreif" class="modal-body mt-4">
                    <div class="mb-4">
                        <label for="brandDescription">Briefly describe your brand and its core values</label>
                        <textarea wire:model="brandDescription" class="form-style" id="brandDescription" rows="3"></textarea>
                        @error('brandDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="brandGoals">What are the main goals for this social media project? (e.g.,
                            increase followers, drive engagement, generate leads, boost sales)</label>
                        <textarea wire:model="brandGoals" class="form-style" id="brandGoals" rows="3"></textarea>
                        @error('brandGoals')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="brandObjective">What does long-term success look like for this project on
                            social media?</label>
                        <textarea wire:model="brandObjective" class="form-style" id="brandObjective" rows="3"></textarea>
                        @error('brandObjective')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="campaignTimelines">Are there any important dates, events, or timelines for
                            this project?</label>
                        <textarea wire:model="campaignTimelines" class="form-style" id="campaignTimelines" rows="3"></textarea>
                        @error('campaignTimelines')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="brandVoice">What tone and voice should be used for this project's social
                            media content?</label>
                        <textarea wire:model="brandVoice" class="form-style" id="brandVoice" rows="3"></textarea>
                        @error('brandVoice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="avoidWords">Are there any topics, themes, or messaging to avoid for this
                            project?</label>
                        <textarea wire:model="avoidWords" class="form-style" id="avoidWords" rows="3"></textarea>
                        @error('avoidWords')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="competitors">List 3 main competitors for this project and what makes your
                            brand/project unique on social media</label>
                        <textarea wire:model="competitors" class="form-style" id="competitors" rows="3"></textarea>
                        @error('competitors')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="platforms">Which social media platforms are most important for this project
                            and why?</label>
                        <textarea wire:model="platforms" class="form-style" id="platforms" rows="3"></textarea>
                        @error('platforms')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
