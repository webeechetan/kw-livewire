<?php

namespace App\Livewire\Projects\Components;

use App\Models\Brand;
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
    public $number_of_posts = '';
    public $platforms = '';
    public $goals = '';
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
        $brandName = $this->project->name;
        $brandSettings = $this->project->brief->brief;
        $brandSettings = json_decode($brandSettings, true);
        $openAIService = new OpenAIService();

        $startDate = $this->start_date ?? now()->startOfMonth()->toDateString();
        $endDate = $this->end_date ?? now()->endOfMonth()->toDateString();
        $numberOfPosts = $this->number_of_posts;
        $platforms = is_array($this->platforms) ? $this->platforms : explode(',', $this->platforms);
        $goals = is_array($this->goals) ? $this->goals : explode(',', $this->goals);

        $contentPlan = new ContentPlan();
        $contentPlan->project_id = $this->project->id;
        $contentPlan->title = $this->title ?: 'Content Plan for ' . $brandName . ' - ' . now()->format('F');
        $contentPlan->duration = Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date));
        $contentPlan->number_of_posts = $this->number_of_posts;
        $contentPlan->platforms = $this->platforms;
        $contentPlan->start_date = $this->start_date ?: now()->startOfMonth();
        $contentPlan->end_date = $this->end_date ?: now()->endOfMonth();
        $contentPlan->status = 'draft';
        $contentPlan->save();

        // Call OpenAIService to generate the content plan
        $contentCalendar = $openAIService->generateContentPlan(
            $brandName,
            $startDate,
            $endDate,
            $brandSettings,
            $numberOfPosts,
            $platforms,
            $goals
        );

        dd($contentCalendar);
        if (is_array($contentCalendar)) {
            foreach ($contentCalendar as $postData) {
                $post = new Post();
                $post->project_id = $this->project->id;
                $post->content_plan_id = $contentPlan->id;
                $post->date = $postData['date'] ?? null;
                $post->platform = $postData['platform'] ?? null;
                $post->status = 'draft';
                $post->title = 'Post for ' . ($postData['date'] ?? '') . ' on ' . ($postData['platform'] ?? '');
                $post->description = $postData['post'] ?? ($postData['idea'] ?? '');
                $post->format = $postData['format'] ?? null;
                $post->content_bucket = $postData['content_bucket'] ?? ($postData['bucket'] ?? null);
                $post->content_idea = $postData['content_idea'] ?? ($postData['idea'] ?? null);
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
