<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithPagination;
use App\Helpers\Helper;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;


class ListClient extends Component
{
    use WithPagination;

    // check for refreshClients event

    protected $listeners = ['refreshClients' => '$refresh'];

    public $query = '';

    //  filters & sorts

    public $sort = 'all';
    public $filter = 'all';


    public $client_onboard_date;
    public $client_name;
    public $client_description;
    public $client_image;

    public $client;

    public function render()
    {
        $clients = Client::where('name','like','%'.$this->query.'%');

        if($this->sort == 'newest'){
            $clients->orderBy('created_at','desc');
        }elseif($this->sort == 'oldest'){
            $clients->orderBy('created_at','asc');
        }elseif($this->sort == 'a_z'){
            $clients->orderBy('name','asc');
        }elseif($this->sort == 'z_a'){
            $clients->orderBy('name','desc');
        }

        if($this->filter == 'active'){
            $clients->where('status','active');
        }elseif($this->filter == 'completed'){
            $clients->where('status','completed');
        }elseif($this->filter == 'archived'){
            $clients->onlyTrashed();
        }


        $clients = $clients->paginate(9);

        return view('livewire.clients.list-client',[
            'clients' => $clients,
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

    public function emitRestoreEvent($clientId)
    {
        $this->dispatch('restoreClient', $clientId);
    }

    public function emitForceDeleteEvent($clientId)
    {
        $this->dispatch('forceDeleteClient', $clientId);
    }

    public function search()
    {
        $this->resetPage();
    }

}
