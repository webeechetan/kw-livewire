<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Client;
use App\Helpers\Helper;

class AddClient extends Component
{
    public $client_onboard_date;
    public $client_name;
    public $client_description;
    public $client_image;

    public $client;

    protected $listeners = ['editClient', 'deleteClient'];

    public function render()
    {
        return view('livewire.components.add-client');
    }

    public function addClient()
    {
        if($this->client){
            $this->updateClient();
            return;
        }
        
        $this->validate([
            'client_name' => 'required',
        ]);
        
        $client = new Client();
        $client->org_id = session('org_id');
        $client->name = $this->client_name;
        $client->onboard_date = $this->client_onboard_date;
        $client->description = $this->client_description;
        if($this->client_image){
            $this->validate([
                'client_image' => 'image|max:1024', // 1MB Max
            ]);

            $image = $this->client_image->store('public/images/clients');
            // remove public from the path as we need to store only the path in the db
            $image = str_replace('public/', '', $image);
            
            $client->image = $image;
        }else{
            $client->image = Helper::createAvatar($this->client_name,'clients');
        }
        // create a folder for the client
        $path = 'storage/'. session('org_name') . '/clients/' . $this->client_name;

        $path = public_path($path);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $client->save();
        $this->dispatch('success', 'Client added successfully');
        $this->dispatch('client-added');
        $this->dispatch('saved');
        $this->resetForm();

    }

    public function editClient($id)
    {
        $this->client = Client::find($id);
        $this->client_name = $this->client->name;
        $this->client_description = $this->client->description;
        $this->client_onboard_date = $this->client->onboard_date;
        $this->dispatch('edit-client', $this->client);
    }

    public function updateClient(){
        $this->validate([
            'client_name' => 'required',
        ]);
        $client = Client::find($this->client->id);
        $client->name = $this->client_name;
        $client->onboard_date = $this->client_onboard_date;
        $client->description = $this->client_description;
        if($this->client_image){
            $this->validate([
                'client_image' => 'image|max:1024', // 1MB Max
            ]);

            $image = $this->client_image->store('public/images/clients');
            // remove public from the path as we need to store only the path in the db
            $image = str_replace('public/', '', $image);
            
            $client->image = $image;
        }
        $client->save();
        $this->dispatch('success', 'Client updated successfully');
        $this->dispatch('client-added');
        $client = null;
        $this->dispatch('saved');
        $this->resetForm();
        

    }

    public function deleteClient($id)
    {
        $client = Client::find($id);
        $client->delete();
        $this->dispatch('success', 'Client deleted successfully');
        $this->dispatch('saved');
    }

    public function resetForm(){
        $this->client = null;
        $this->client_name = '';
        $this->client_description = '';
        $this->client_onboard_date = '';
        $this->client_image = '';
    }
}
