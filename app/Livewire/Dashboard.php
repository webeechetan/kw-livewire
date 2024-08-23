<?php

namespace App\Livewire;

use Livewire\Component;
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }

    public function mount(){
        $tour = session()->get('tour');
        if(request()->tour == 'close-main-tour'){
            // $tour['main_tour'] = false;
            unset($tour['main_tour']);
            session()->put('tour',$tour);
        }
    }
}
