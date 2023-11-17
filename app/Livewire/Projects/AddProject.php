<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;
use App\Models\Client;

class AddProject extends Component
{
    public $clients;
    public $name;
    public $client_id;
    public $description;


    public function render()
    {
        return view('livewire.projects.add-project');
    }

    public function mount()
    {
        $this->clients = Client::limit(100)->get();
    }

    public function AddProject(){
        $this->validate([
            'name' => 'required',
            'client_id' => 'required',
            'description' => 'required'
        ]);

        $project = new Project();
        $project->name = $this->name;
        $project->client_id = $this->client_id;
        $project->description = $this->description;
        $project->org_id = session('org_id');
        $project->save();
        
        session()->flash('success','Project added successfully');
        return $this->redirect(route('project.index'),navigate: true);
    }
}
