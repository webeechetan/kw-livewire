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
                <form wire:submit.prevent="saveProjectBrief" class="modal-body mt-4">
                    <div class="mb-4">
                        <label for="description">Briefly describe your brand and its core values</label>
                        <textarea wire:model="description" class="form-style" id="description" rows="3"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="goals">What are the main goals for this social media project? (e.g.,
                            increase followers, drive engagement, generate leads, boost sales)</label>
                        <textarea wire:model="goals" class="form-style" id="goals" rows="3"></textarea>
                        @error('goals')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="objectives">What does long-term success look like for this project on
                            social media?</label>
                        <textarea wire:model="objectives" class="form-style" id="objectives" rows="3"></textarea>
                        @error('objectives')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="timelines">Are there any important dates, events, or timelines for
                            this project?</label>
                        <textarea wire:model="timelines" class="form-style" id="timelines" rows="3"></textarea>
                        @error('timelines')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="toneOfVoice">What tone and voice should be used for this project's social
                            media content?</label>
                        <textarea wire:model="toneOfVoice" class="form-style" id="toneOfVoice" rows="3"></textarea>
                        @error('toneOfVoice')
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
