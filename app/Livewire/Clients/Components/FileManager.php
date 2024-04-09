<?php

namespace App\Livewire\Clients\Components;

use Livewire\Component;
use App\Models\Client;
use Illuminate\Contracts\Filesystem\Cloud;

class FileManager extends Component
{
    public $id;
    public $client;

    public function render()
    {
        return view('livewire.clients.components.file-manager');
    }

    public function mount($id)
    {
        $this->authorize('View Client');
        $this->id = $id;
        $this->client = Client::find($id);
    }
}
