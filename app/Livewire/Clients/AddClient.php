<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;

class AddClient extends Component
{
    public $name;
    public $description;
    public function render()
    {
        return view('livewire.clients.add-client');
    }

    public function addClient()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $client = new Client();
        $client->org_id = session('org_id');
        $client->name = $this->name;
        $client->description = $this->description;
        $client->save();
        session()->flash('success', 'Client added successfully.');
        return $this->redirect(route('client.index'), navigate: true);
    }
}
