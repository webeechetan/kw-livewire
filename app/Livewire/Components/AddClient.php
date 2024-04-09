<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Client;
use App\Helpers\Helper;
use Livewire\WithFileUploads;

class AddClient extends Component
{
    use WithFileUploads;

    public $client_onboard_date;
    public $client_name;
    public $client_description;
    public $client_image;
    public $brand_name;
    public $use_brand_name;
    public $point_of_contact;

    public $client;

    protected $listeners = ['editClient', 'deleteClient','restoreClient','forceDeleteClient'];

    public function render()
    {
        return view('livewire.components.add-client');
    }

    public function addClient()
    {
        $this->authorize('Create Client');
        if($this->client){
            $this->updateClient();
            return;
        }
        
        $this->validate([
            'client_name' => 'required|unique:clients,name',
        ]);
        
        $client = new Client();
        $client->org_id = session('org_id');
        $client->name = $this->client_name;
        $client->onboard_date = $this->client_onboard_date;
        $client->description = $this->client_description;
        $client->brand_name = $this->brand_name;
        $client->use_brand_name = $this->use_brand_name;
        $client->created_by = session('user')->id;
        $client->point_of_contact = $this->point_of_contact;

        if($this->client_image){
            $this->validate([
                'client_image' => 'image|max:1024', // 1MB Max
            ]);

            $image = $this->client_image->store('images/clients');
            // remove public from the path as we need to store only the path in the db
            $image = str_replace('public/', '', $image);
            
            $client->image = $image;
        }
        // create a folder for the client
        if($client->use_brand_name){
            $path = 'storage/'. session('org_name') . '/clients/' . $this->brand_name;
        }else{
            $path = 'storage/'. session('org_name') . '/clients/' . $this->client_name;
        }



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
        $this->brand_name = $this->client->brand_name;
        $this->use_brand_name = $this->client->use_brand_name;
        $this->point_of_contact = $this->client->point_of_contact;
        $this->dispatch('edit-client', $this->client);
    }

    public function updateClient(){
        $this->authorize('Edit Client');
        $this->validate([
            'client_name' => 'required',
        ]);
        $client = Client::find($this->client->id);
        $client->name = $this->client_name;
        $client->onboard_date = $this->client_onboard_date;
        $client->description = $this->client_description;
        $client->brand_name = $this->brand_name;
        $client->use_brand_name = $this->use_brand_name;
        $client->point_of_contact = $this->point_of_contact;
        if($this->client_image){
            $this->validate([
                'client_image' => 'image|max:1024', // 1MB Max
            ]);

            $image = $this->client_image->store('images/clients');
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
        $this->authorize('Delete Client');
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
        $this->brand_name = '';
        $this->use_brand_name = '';
        $this->point_of_contact = '';
    }

    public function restoreClient($id)
    {
        $client = Client::withTrashed()->find($id);
        $client->restore();
        $this->dispatch('success', 'Client restored successfully');
        $this->dispatch('saved');
    }

    public function forceDeleteClient($id)
    {
        $client = Client::withTrashed()->find($id);
        $client->forceDelete();
        $this->dispatch('success', 'Client deleted successfully');
        $this->dispatch('saved');
    }
}
