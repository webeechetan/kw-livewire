<?php

namespace App\Livewire\Projects\Components;

use Livewire\Component;
use App\Models\ContentPlan as ContentPlanModel;
use App\Models\Project as ProjectModel;
use App\Models\Post as PostModel;
use App\Models\User;
use App\Models\Post;
use App\Services\OpenAIService;
use Illuminate\Process\FakeProcessDescription;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use App\Imports\PostsImport;
use Maatwebsite\Excel\Facades\Excel;


class ContentPlan extends Component
{
    use WithFileUploads;

    public $project;
    public $contentPlan;
    public $users = [];

    // post attributes
    public $post_date;
    public $platforms;
    public $format;
    public $content_bucket;
    public $content_idea;

    // import post attribute
    public $postFile;

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

    public function createPost(){
        $post = new Post();
        $post->project_id = $this->project->id;
        $post->content_plan_id = $this->contentPlan->id;
        $post->date = $this->post_date;
        $post->platform = $this->platforms;
        $post->status = 'pending';
        $post->format = $this->format;
        $post->content_bucket = $this->content_bucket;
        $post->content_idea = $this->content_idea;
        // $post->creative_copy = $postData['creative_copy'] ?? null;
        // $post->visual_direction = $postData['visual_direction'] ?? null;
        // $post->caption = $postData['caption'] ?? null;
        $post->save();
        $this->dispatch('post-created',$post);
        $this->redirect(route('project.content-plan', [$this->project->id, $this->contentPlan->id]));

    }

    public function saveColumnValue($postId,$columnName,$columnValue){
        $post = Post::find($postId);
        $post->$columnName = $columnValue;
        $post->save();
    }

    public function importPost()
{
    $type = match ($this->postFile->getClientOriginalExtension()) {
        'csv' => \Maatwebsite\Excel\Excel::CSV,
        'xls' => \Maatwebsite\Excel\Excel::XLS,
        'xlsx' => \Maatwebsite\Excel\Excel::XLSX,
        default => throw new \Exception('Unsupported file type'),
    };

    $import = new PostsImport($this->contentPlan->id, $this->project->id);

    try {
        \Maatwebsite\Excel\Facades\Excel::import(
            $import,
            $this->postFile->getRealPath(),
            null,
            $type
        );
    } catch (\Exception $e) {
        $import->report['header_error'] = $e->getMessage();
    }
    $report = $import->getReport();

    $this->dispatch('imported',$report);
}


}
