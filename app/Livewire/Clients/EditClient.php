<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class EditClient extends Component
{
    use WithFileUploads;

    public $client;
    public $name;
    public $description;
    public $image;

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
        ]);

        $client = Client::find($this->client->id);
        $client->name = $this->name;
        $client->description = $this->description;

        if($this->image){
            $this->validate([
                'image' => 'image|max:1024', // 1MB Max
            ]);

            $image = $this->image->store('public/images/clients');
            // remove public from the path as we need to store only the path in the db
            $image = str_replace('public/', '', $image);
            
            $client->image = $image;
        }

        $client->save();
        
        session()->flash('success','Client updated successfully');
        return $this->redirect(route('client.index'), navigate: true);
    }

}
