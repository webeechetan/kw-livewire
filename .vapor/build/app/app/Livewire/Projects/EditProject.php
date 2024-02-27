<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Project;
use App\Models\Client;


class EditProject extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $project;
    public $clients;
    public $client_id;


    public function render()
    {
        return view('livewire.projects.edit-project');
    }

    public function mount($id){
        $this->project = Project::find($id);
        $this->name = $this->project->name;
        $this->description = $this->project->description;
        $this->client_id = $this->project->client_id;
        $this->clients = Client::all();
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'client_id' => 'required',
        ]);

        $project = Project::find($this->project->id);
        $project->name = $this->name;
        $project->description = $this->description;
        $project->client_id = $this->client_id;
        $project->save();

        session()->flash('success','Project updated successfully');
        return $this->redirect(route('project.index'),navigate:true);
    }
}
