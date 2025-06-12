<?php

namespace App\Livewire\Projects\Components;

use Livewire\Component;
use App\Models\ContentPlan as ContentPlanModel;
use App\Models\Project as ProjectModel;
use App\Models\Post as PostModel;
use App\Services\OpenAIService;
use Illuminate\Process\FakeProcessDescription;
use Illuminate\Support\Facades\Log;

class ContentPlan extends Component
{
    public $project;
    public $contentPlan;

    public function mount($project, $contentPlan = null )
    {
        $this->project = ProjectModel::find($project);
        $this->contentPlan = ContentPlanModel::find($contentPlan);
    }

    public function render()
    {
        return view('livewire.projects.components.content-plan');
    }

    public function regeneratePost($id)
    {
        $post = PostModel::find($id);    
        $openAIService = new OpenAIService();
        $newPost = $openAIService->regeneratePost($post);
        $post->description = $newPost;
        $post->save();
        $this->dispatch('postRegenerated', $post->toArray());
    }


}
