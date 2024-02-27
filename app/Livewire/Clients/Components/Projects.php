<?php

namespace App\Livewire\Clients\Components;

use Livewire\Component;
use App\Models\Client;
use Database\Factories\ClientFactory;

class Projects extends Component
{
    public $id;
    public $client;
    public $projects;

    public $active_projects;
    public $completed_projects;
    public $overdue_projects;
    public $archived_projects;

    public function render()
    {
        return view('livewire.clients.components.projects');
    }

    public function mount($id)
    {
        $this->id = $id;
        $this->client = Client::find($id);
        $this->projects = $this->client->projects;
        $this->active_projects = $this->client->projects()->where('status', 'active')->get();
        $this->completed_projects = $this->client->projects()->where('status', 'completed')->get();
        $this->overdue_projects = $this->client->projects()->where('status', 'overdue')->get();
        $this->archived_projects = $this->client->projects()->where('status', 'archived')->get();

    }
}
