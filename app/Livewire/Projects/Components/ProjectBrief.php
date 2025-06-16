<?php

namespace App\Livewire\Projects\Components;

use Livewire\Component;
use App\Models\Project;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectBrief as ProjectBriefModel;

class ProjectBrief extends Component
{
    public Project $project;

    public $description = '';
    public $goals = '';
    public $objectives = '';
    public $timelines = '';
    public $toneOfVoice = '';
    public $avoidWords = '';
    public $competitors = '';
    public $platforms = '';

    public function render()
    {
        return view('livewire.projects.components.project-brief');
    }

    public function mount(Project $project)
    {
        $this->project = $project;

        if($project->brief) {
            $brief = json_decode($project->brief->brief, true);

            $this->description = $brief['description'] ?? '';
            $this->goals = $brief['goals'] ?? '';
            $this->objectives = $brief['objectives'] ?? '';
            $this->timelines = $brief['timelines'] ?? '';
            $this->toneOfVoice = $brief['toneOfVoice'] ?? '';
            $this->avoidWords = $brief['avoidWords'] ?? '';
            $this->competitors = $brief['competitors'] ?? '';
            $this->platforms = $brief['platforms'] ?? '';
        }
    }

    public function saveProjectBrief()
    {
        
        $this->validate([
            'description' => 'required',
        ]);

        $briefData = [
            'description' => $this->description,
            'goals' => $this->goals,
            'objectives' => $this->objectives,
            'timelines' => $this->timelines,
            'toneOfVoice' => $this->toneOfVoice,
            'avoidWords' => $this->avoidWords,
            'competitors' => $this->competitors,
            'platforms' => $this->platforms,
        ];

        $briefData = json_encode($briefData);

        $brief = ProjectBriefModel::updateOrCreate(
            ['project_id' => $this->project->id],
            [
                'brief' => $briefData,
            ]
        );

        $this->dispatch('success', 'Project brief saved successfully!');
    }
}