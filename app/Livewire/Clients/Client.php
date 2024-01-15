<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client as ClientModel;
use Illuminate\Http\Request;

class Client extends Component
{

    public $client_id;

    public $client;

    public function render()
    {
        return view('livewire.clients.client');
    }

    public function boot(Request $request)
    {
        $this->client_id =  $request->id;
        $this->client = ClientModel::find($this->client_id);
    }
}
