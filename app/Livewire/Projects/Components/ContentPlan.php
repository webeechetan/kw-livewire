<?php

namespace App\Livewire\Projects\Components;

use Livewire\Component;
use App\Models\ContentPlan as ContentPlanModel;
use App\Models\Project as ProjectModel;
use App\Models\Post as PostModel;
use App\Models\User;
use App\Services\OpenAIService;
use Illuminate\Process\FakeProcessDescription;
use Illuminate\Support\Facades\Log;

class ContentPlan extends Component
{
    public $project;
    public $contentPlan;
    public $users = [];

    public function mount($project, $contentPlan = null )
    {
        $this->project = ProjectModel::find($project);
        $this->contentPlan = ContentPlanModel::find($contentPlan);
        $this->users = User::pluck('name','id')->toArray();
        // dd($this->users);
       
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

    public function regenerateCreativeCopy($id)
    {
        $post = PostModel::find($id);
        $openAIService = new OpenAIService();
        $newCreativeCopy = $openAIService->regenerateCreativeCopy(
            json_decode($this->project->brief->brief, true),
            $this->contentPlan->toArray(),
            $post->toArray()
        );
        $post->creative_copy = $newCreativeCopy;
        $post->save();
        $this->dispatch('postRegenerated', $post->toArray());
    }

    public function regenerateVisualDirection($id){
        $post = PostModel::find($id);
        $openAIService = new OpenAIService();
        $newVisualDirection = $openAIService->regenerateVisualDirection(
            json_decode($this->project->brief->brief, true),
            $this->contentPlan->toArray(),
            $post->toArray()
        );
        $post->visual_direction = $newVisualDirection;
        $post->save();
        $this->dispatch('postRegenerated', $post->toArray());
    }

    public function regenerateCaption($id){
        $post = PostModel::find($id);
        $openAIService = new OpenAIService();
        $newCaption = $openAIService->regeneratePostCopy(
            json_decode($this->project->brief->brief, true),
            $this->contentPlan->toArray(),
            $post->toArray()
        );
        $post->caption = $newCaption;
        $post->save();
        $this->dispatch('postRegenerated', $post->toArray());
    }

    public function deletePost($id){
        $post = PostModel::find($id);
        $post->delete();
        $this->dispatch('postDeleted', $post->id);
    }

    public function generateColumnValue($columnName, $columnValue, $columnId){
        $post = PostModel::find($columnId);
        $openAIService = new OpenAIService();
       

        
        if($columnName == 'creative_copy'){
            $generatedValue = $openAIService->regenerateCreativeCopy(
                json_decode($this->project->brief->brief, true),
                $this->contentPlan->toArray(),
                $post->toArray()
            );
        }

        if($columnName == 'visual_direction'){
            $generatedValue = $openAIService->regenerateVisualDirection(
                json_decode($this->project->brief->brief, true),
                $this->contentPlan->toArray(),
                $post->toArray()
            );
        }

        if($columnName == 'caption'){
            $generatedValue = $openAIService->regeneratePostCopy(
                json_decode($this->project->brief->brief, true),
                $this->contentPlan->toArray(),
                $post->toArray()
            );
        }

        $this->dispatch('postRegenerated', $generatedValue);
    }

    public function applyColumnValue($columnName, $columnValue, $columnId){
        
        $post = PostModel::find($columnId);
        $post->$columnName = $columnValue;
        $post->save();
        $this->dispatch('postApplied', $post->toArray());
    }

}
