<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithFileUploads;
use App\Helpers\Helper;


class AddClient extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $image;

    public function render()
    {
        return view('livewire.clients.add-client');
    }

    public function addClient()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $client = new Client();
        $client->org_id = session('org_id');
        $client->name = $this->name;
        if($this->image){
            $this->validate([
                'image' => 'image|max:1024', // 1MB Max
            ]);

            $image = $this->image->store('public/images/clients');
            // remove public from the path as we need to store only the path in the db
            $image = str_replace('public/', '', $image);
            
            $client->image = $image;
        }else{
            $client->image = Helper::createAvatar($this->name,'clients');
        }


        $client->description = $this->description;
        $client->save();
        session()->flash('success', 'Client added successfully.');
        return $this->redirect(route('client.index'), navigate: true);
    }
}
