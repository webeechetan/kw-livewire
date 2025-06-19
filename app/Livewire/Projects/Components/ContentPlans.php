<?php

namespace App\Livewire\Projects\Components;

use App\Models\Project;
use App\Models\ContentPlan;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ContentPlans extends Component
{
    public Project $project;

    public $title = '';
    public $description = '';
    public $number_of_posts = '';
    public $platforms = '';
    public $start_date = '';
    public $end_date = '';

    public $contentPlans = [];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->contentPlans = ContentPlan::where('project_id', $this->project->id)->get();
    }

    public function generateContentPlan()
    {
        $projectName = $this->project->name;
        $projectBrief = $this->project->brief->brief;
        $projectBrief = json_decode($projectBrief, true);
        $openAIService = new OpenAIService();

        // Create content plan brief object
        $contentPlanBrief = [
            'title' => $this->title,
            'description' => $this->description,
            'number_of_posts' => $this->number_of_posts,
            'platforms' => $this->platforms,
            'start_date' => $this->start_date ?? now()->startOfMonth()->toDateString(),
            'end_date' => $this->end_date ?? now()->endOfMonth()->toDateString(),
        ];

        $contentPlan = new ContentPlan();
        $contentPlan->project_id = $this->project->id;
        $contentPlan->title = $this->title ?: 'Content Plan for ' . $projectName . ' - ' . now()->format('F');
        $contentPlan->description = $this->description;
        $contentPlan->number_of_posts = $this->number_of_posts;
        $contentPlan->platforms = $this->platforms;
        $contentPlan->start_date = $contentPlanBrief['start_date'];
        $contentPlan->end_date = $contentPlanBrief['end_date'];
        $contentPlan->status = 'draft';
        $contentPlan->save();

        // Call OpenAIService to generate the content plan
        $generatedPosts = $openAIService->generateContentPlan(
            projectName: $projectName,
            contentPlanBrief: $contentPlanBrief,
            projectBrief: $projectBrief
        );

        if (is_array($generatedPosts)) {
            foreach ($generatedPosts as $postData) {
                $post = new Post();
                $post->project_id = $this->project->id;
                $post->content_plan_id = $contentPlan->id;
                $post->date = $postData['date'] ?? null;
                $post->platform = $postData['platform'] ?? null;
                $post->status = 'pending';
                $post->format = $postData['format'] ?? null;
                $post->content_bucket = $postData['content_bucket'] ?? ($postData['bucket'] ?? null);
                $post->content_idea = $postData['idea'] ?? null;
                $post->creative_copy = $postData['creative_copy'] ?? null;
                $post->visual_direction = $postData['visual_direction'] ?? null;
                $post->caption = $postData['caption'] ?? null;
                $post->save();
            }
        }

        $this->redirect(route('project.content-plan', [$this->project->id, $contentPlan->id]));
    }

    public function render()
    {
        return view('livewire.projects.components.content-plans');
    }
}
