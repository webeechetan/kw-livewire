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

    public $brandDescription = '';
    public $brandGoals = '';
    public $brandObjective = '';
    public $campaignTimelines = '';
    public $brandVoice = '';
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

            $this->brandDescription = $brief['brandDescription'] ?? '';
            $this->brandGoals = $brief['brandGoals'] ?? '';
            $this->brandObjective = $brief['brandObjective'] ?? '';
            $this->campaignTimelines = $brief['campaignTimelines'] ?? '';
            $this->brandVoice = $brief['brandVoice'] ?? '';
            $this->avoidWords = $brief['avoidWords'] ?? '';
            $this->competitors = $brief['competitors'] ?? '';
            $this->platforms = $brief['platforms'] ?? '';
        }
    }

    public function saveProjectBrief()
    {
        
        $this->validate([
            'brandDescription' => 'required',
        ]);

        $briefData = [
            'brandDescription' => $this->brandDescription,
            'brandGoals' => $this->brandGoals,
            'brandObjective' => $this->brandObjective,
            'campaignTimelines' => $this->campaignTimelines,
            'brandVoice' => $this->brandVoice,
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