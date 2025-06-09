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

class BrandSetting extends Component
{
    public Project $project;

    public $title = '';
    public $duration = '';
    public $number_of_posts = '';
    public $platforms = '';
    public $goals = '';

    public $contentPlans = [];


    public function mount(Project $project)
    {
        $this->project = $project;
        $this->contentPlans = ContentPlan::where('project_id', $this->project->id)->get();
    }

    public function generateContentCalendar()
    {
        $brandName = $this->project->name;
        $month = date('F');
        $brandSettings = $this->project->brief->brief;
        $brandSettings = json_decode($brandSettings, true);
        $openAIService = new OpenAIService();

        $contentPlan = new ContentPlan();
        $contentPlan->project_id = $this->project->id;
        $contentPlan->title = $this->title ?: 'Content Plan for ' . $brandName . ' - ' . $month;
        $contentPlan->duration = $this->duration;
        $contentPlan->number_of_posts = $this->number_of_posts;
        $contentPlan->platforms = $this->platforms;
        $contentPlan->start_date = now()->startOfMonth();
        $contentPlan->end_date = now()->endOfMonth();
        $contentPlan->status = 'draft';

        $contentPlan->save();


        // dd($this->duration, $this->number_of_posts, $this->platforms, $this->goals);

        // $contentCalendar = $openAIService->generateContentCalendar($brandName, $brandSettings, $month,  $this->duration, $this->number_of_posts, $this->platforms, $this->goals);
        $contentCalendar =
            [
                [
                    'date' => '2025-05-01',
                    'platform' => 'Twitter',
                    'status' => 'draft',
                    'post' => 'Acma is proud to be leading the automotive component industry and offering state-of-the-art technology solutions. #AutomotiveIndustry #ACMA',
                    'format' => 'Story',
                    'content_bucket' => 'educational',
                    'content_idea' => 'industry insights',
                ],
                [
                    'date' => '2025-05-06',
                    'platform' => 'Twitter',
                    'status' => 'draft',
                    'post' => 'We\'re driving the future of the automotive industry in India, join us on this journey. #Innovation #ACMA',
                    'format' => 'Text',
                    'content_bucket' => 'inspirational',
                    'content_idea' => 'brand mission',
                ],
                [
                    'date' => '2025-05-11',
                    'platform' => 'LinkedIn',
                    'status' => 'draft',
                    'post' => 'ACMA is excited to introduce our latest advancement in auto component technology. Stay tuned! #Technology #Innovation',
                    'format' => 'Story',
                    'content_bucket' => 'educational',
                    'content_idea' => 'product announcement',
                ],
                [
                    'date' => '2025-05-16',
                    'platform' => 'Twitter',
                    'status' => 'draft',
                    'post' => 'We believe in quality. We wouldn\'t provide anything less to our partners in the automotive industry. #Quality #ACMA',
                    'format' => 'Text',
                    'content_bucket' => 'educational',
                    'content_idea' => 'values',
                ],
                [
                    'date' => '2025-05-21',
                    'platform' => 'LinkedIn',
                    'status' => 'draft',
                    'post' => 'Our database of automotive companies continues to grow, so does our commitment to excellence and innovation. #Growth #ACMA',
                    'format' => 'Text',
                    'content_bucket' => 'inspirational',
                    'content_idea' => 'company growth',
                ],
                [
                    'date' => '2025-05-26',
                    'platform' => 'Twitter',
                    'status' => 'draft',
                    'post' => 'ACMA has the expertise for all types of automotive component manufacturing. Trust in us! #Automotive #Expertise',
                    'format' => 'Story',
                    'content_bucket' => 'educational',
                    'content_idea' => 'expertise',
                ],
                [
                    'date' => '2025-05-31',
                    'platform' => 'LinkedIn',
                    'status' => 'draft',
                    'post' => 'As we round off this month, we\'d like to thank all our partners and customers for their support. Together, we drive the future! #ThankYou #ACMA',
                    'format' => 'Post',
                    'content_bucket' => 'entertaining',
                    'content_idea' => 'gratitude',
                ],
            ];

        if(is_array($contentCalendar)) {
            foreach ($contentCalendar as $postData) {
                $post = new Post();
                $post->project_id = $this->project->id;
                $post->content_plan_id = $contentPlan->id;
                $post->date = $postData['date'];
                $post->platform = $postData['platform'];
                $post->status = $postData['status'];
                $post->title = 'Post for ' . $postData['date'] . ' on ' . $postData['platform'];
                $post->description = $postData['post'];
                $post->format = $postData['format'];
                $post->content_bucket = $postData['content_bucket'];
                $post->content_idea = $postData['content_idea'];
                $post->save();
            }
        }

        $this->redirect(route('project.content-plan', [$this->project->id, $contentPlan->id]));
    }

    public function render()
    {
        return view('livewire.projects.components.brand-setting');
    }
}
