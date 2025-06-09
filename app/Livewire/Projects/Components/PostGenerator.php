<?php

namespace App\Livewire\Projects\Components;

use Livewire\Component;
use App\Models\Project;
use App\Services\OpenAIService;

class PostGenerator extends Component
{
    public $project;
    public $content = '';    
    public $prompt;

    public function render()
    {
        return view('livewire.projects.components.post-generator');
    }

    public function mount(Project $project)
    {
    }

    public function generatePost(){
        $openAI = new OpenAIService();
        $this->content = $openAI->generateSocialMediaPost($this->prompt);
        $this->dispatch('contentGenerated', $this->content);
        // $this->content = '';
        $this->prompt = '';
    }


}
