<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;


class ListProject extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.projects.list-project',[
            'projects' => Project::paginate(9),
        ]);
    }
}
