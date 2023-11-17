<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Illuminate\Http\Request;

class EditClient extends Component
{
    public $client;
    public $name;
    public $description;

    public function render()
    {
        return view('livewire.clients.edit-client');
    }

    public function mount($id)
    {
        $this->client = Client::find($id);
        $this->name = $this->client->name;
        $this->description = $this->client->description;
    }

    public function updateClient(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $client = Client::find($this->client->id);
        $client->name = $this->name;
        $client->description = $this->description;
        $client->save();
        
        session()->flash('success','Client updated successfully');
        return $this->redirect(route('client.index'), navigate: true);
    }

}
