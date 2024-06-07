<?php

namespace App\Livewire\Clients\Components;

use Livewire\Component;
use App\Models\Client;
use Database\Factories\ClientFactory;
use Livewire\Attributes\On; 

class Projects extends Component
{
    public $id;
    public $client;
    public $projects;
    public $filter = 'all';
    public $sort = 'all';

    public $all_projects;
    public $active_projects;
    public $completed_projects;
    public $overdue_projects;
    public $archived_projects;

    protected $listeners = ['project-added' => 'refresh', 'project-updated' => 'refresh', 'project-deleted' => 'refresh'];

    public function render()
    {
        return view('livewire.clients.components.projects');
    }

    public function refresh(){
        $this->mount($this->id);
    }

    public function mount($id)
    {
        $this->authorize('View Client');
        $this->id = $id;
        $this->client = Client::find($id);
        $this->projects = $this->client->projects;
        $this->all_projects = $this->client->projects;
        $this->active_projects = $this->client->projects()->where('status', 'active')->get();
        $this->completed_projects = $this->client->projects()->where('status', 'completed')->get();
        $this->overdue_projects = $this->client->projects()->where('status', 'overdue')->get();
        $this->archived_projects = $this->client->projects()->where('status', 'archived')->get();

    }
    
    public function emitEditEvent($id)
    {
        $this->dispatch('editProject', $id);
    }

    public function emitDeleteEvent($id)
    {
        $this->dispatch('deleteProject', $id);
    }

}
