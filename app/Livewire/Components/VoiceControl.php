<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Client;

class VoiceControl extends Component
{
    public function render()
    {
        return view('livewire.components.voice-control');
    }

    public function createClient($name)
    {
        $client = new Client();
        $client->org_id = session('org_id');
        $client->name = $name;
        $client->save();
        $this->dispatch('command-success','Client created successfully');
    }
}
