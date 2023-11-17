<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithPagination;

class ListClient extends Component
{
    use WithPagination;

    public $query = '';

    public function render()
    {
        return view('livewire.clients.list-client',[
            'clients' => Client::where('name','like','%'.$this->query.'%')->paginate(9)
        ]);
    }

    public function search()
    {
        $this->resetPage();
    }

    public function deleteClient($id)
    {
        Client::find($id)->delete();
        session()->flash('success', 'Client added successfully.');
    }

    public function mount()
    {

    }
}
