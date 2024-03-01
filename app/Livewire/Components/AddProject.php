<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Helpers\Helper;
use Livewire\WithFileUploads;
use App\Models\Client;


class AddProject extends Component
{
    use WithFileUploads;

    public $users = [];
    public $clients = [];
    
    public $project;
    public $client;
    
    public $client_id;
    public $project_name;
    public $project_description;
    public $project_due_date;
    public $project_start_date;
    public $logo;
    public $project_users = [];
    
    protected $listeners = ['editProject', 'deleteProject','restoreProject','forceDeleteProject'];

    public function render()
    {
        return view('livewire.components.add-project');
    }

    public function mount()
    {
        $this->users = User::all();
        $this->clients = Client::all();
    }

    public function updatedClientId($value)
    {
        $this->client = Client::find($value);
    }


    public function addProject()
    {
        if($this->project){
            $this->updateProject();
            return;
        }

        $this->validate([
            'project_name' => 'required',
        ]);

        $image  = '';

        if (request()->hasFile('image')) {
            $image = $this->image->store('public/images/projects');
            // remove public from the path as we need to store only the path in the db
            $image = str_replace('public/', '', $image);
        }else{
            $image = Helper::createAvatar($this->project_name,'projects');
        }

        // create a folder for the project

        $path = 'storage/'. session('org_name') . '/projects/' . $this->project_name;
        $path = public_path($path);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $project = new Project();
        $project->org_id = session('org_id');
        $project->client_id = $this->client->id;
        $project->description = $this->project_description;
        $project->name = $this->project_name;
        $project->start_date = $this->project_start_date;
        $project->due_date = $this->project_due_date;
        $project->image = $image;
        $project->created_by = session('user')->id;
        try {
            if($project->save()){
                if(count($this->project_users) > 0){
                    $project->users()->sync($this->project_users);
                }
                $project->users()->attach(session('user')->id);
                $this->dispatch('success', 'Project added successfully');
                $this->dispatch('project-added');
                $this->dispatch('saved');
                $this->resetForm();
            }

        } catch (\Exception $e) {
            $this->dispatch('error', 'Error adding project');
            return;
        }
    }

    public function editProject($id)
    {
        $this->project = Project::find($id);
        // dd($this->project);
        $this->client_id = $this->project->client_id;
        $this->project_name = $this->project->name;
        $this->project_description = $this->project->description;
        $this->project_due_date = $this->project->due_date;
        $this->project_start_date = $this->project->start_date;
        $this->project_users = $this->project->users->pluck('id')->toArray();
        $this->dispatch('edit-project', $this->project);
    }

    public function updateProject(){
        $this->validate([
            'project_name' => 'required',
        ]);

        $image  = '';

        if (request()->hasFile('image')) {
            $image = $this->image->store('public/images/projects');
            // remove public from the path as we need to store only the path in the db
            $image = str_replace('public/', '', $image);
        }else{
            $image = $this->project->image;
        }

        $this->project->update([
            'description' => $this->project_description,
            'name' => $this->project_name,
            'start_date' => $this->project_start_date,
            'due_date' => $this->project_due_date,
            'image' => $image,
        ]);

        if(count($this->project_users) > 0){
            $this->project->users()->sync($this->project_users);
        }

        $this->resetForm();

        $this->dispatch('success', 'Project updated successfully.');
        $this->redirect(route('project.index'),navigate:true);

    }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        $project->delete();
        $this->dispatch('success', 'Project deleted successfully.');
        $this->dispatch('saved');
    }


    public function resetForm(){
        $this->project_name = '';
        $this->project_due_date = '';
        $this->project_description = '';
        $this->project_start_date = '';
        $this->project = null;
    }
}
