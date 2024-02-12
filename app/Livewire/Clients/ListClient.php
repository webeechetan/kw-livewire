<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithPagination;
use App\Helpers\Helper;


class ListClient extends Component
{
    use WithPagination;

    // check for refreshClients event

    protected $listeners = ['refreshClients' => '$refresh'];

    public $query = '';

    public $client_onboard_date;
    public $client_name;
    public $client_description;
    public $client_image;

    public $client;

    public function render()
    {
        return view('livewire.clients.list-client',[
            'clients' => Client::where('name','like','%'.$this->query.'%')->paginate(9),
        ]);
    }

    public function emitEditEvent($clientId)
    {
        $this->dispatch('editClient', $clientId);
    }

    public function emitDeleteEvent($clientId)
    {
        $this->dispatch('deleteClient', $clientId);
    }

    public function search()
    {
        $this->resetPage();
    }

    public function mount()
    {

    }
}
