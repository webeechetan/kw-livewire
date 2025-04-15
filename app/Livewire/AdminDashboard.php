<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Component
{
    public function render()
    {
        // $this->dispatch('brandCreated', [
        //     'brand' => '',
        // ]);
        return view('livewire.admin-dashboard');
    }

    public function createBrand($settings){
        $brand = new Brand();
        $brand->name = $settings['brandName'];
        $brand->org_id = session('org_id');
        $brand->created_by = Auth::user()->id;
        $brand->settings = json_encode($settings);
        $brand->save();

        $this->dispatch('brandCreated', [
            'brand' => $brand,
        ]);
    }
}
