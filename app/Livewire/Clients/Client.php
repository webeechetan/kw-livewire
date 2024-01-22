<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client as ClientModel;
use Illuminate\Http\Request;

class Client extends Component
{

    public $client;
    public $client_id;

    public $active_projects;
    public $completed_projects;
    public $overdue_projects;
    public $archived_projects;

    public $project_name;
    public $project_due_date;


    public function render()
    {
        return view('livewire.clients.client');
    }

    public function mount($id)
    {
        $this->client_id = $id;
        $this->client = ClientModel::with('projects')->find($id);
        // dd($this->client);
        $this->active_projects = $this->client->projects()->where('status', 'active')->get();
        // dd($this->client->projects);
        $this->completed_projects = $this->client->projects()->where('status', 'completed')->get();
        $this->overdue_projects = $this->client->projects()->where('status', 'overdue')->get();
        $this->archived_projects = $this->client->projects()->where('status', 'archived')->get();
    }

    public function addProject()
    {
        $this->validate([
            'project_name' => 'required',
        ]);

        $this->client->projects()->create([
            'org_id' => $this->client->org_id,
            'client_id' => $this->client->id,
            'description' => '',
            'name' => $this->project_name,
            'due_date' => $this->project_due_date,
        ]);

        $this->project_name = '';
        $this->project_due_date = '';

        $this->redirect(route('client.profile', $this->client_id),navigate:true);
    }

}
