<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client as ClientModel;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Helpers\Helper;
use Livewire\WithFileUploads;

class Client extends Component
{
    use WithFileUploads;

    public $client;
    public $client_id;

    public $active_projects;
    public $completed_projects;
    public $overdue_projects;
    public $archived_projects;

    public $project_name;
    public $project_start_date;
    public $project_due_date;
    public $project_image;
    public $project_description;


    public $teams;
    public $team_id;
    
    public $users;




    public function render()
    {
        return view('livewire.clients.client');
    }

    public function mount($id)
    {
        $this->client_id = $id;
        $this->client = ClientModel::with('projects')->find($id);
        $this->active_projects = $this->client->projects()->where('status', 'active')->get();
        $this->completed_projects = $this->client->projects()->where('status', 'completed')->get();
        $this->overdue_projects = $this->client->projects()->where('status', 'overdue')->get();
        $this->archived_projects = $this->client->projects()->where('status', 'archived')->get();
        $this->teams = Team::all();
        $this->users = User::all();

    }

    public function addProject()
    {
        $this->validate([
            'project_name' => 'required',
        ]);

        $image  = '';

        if (request()->hasFile('image')) {
            $image = $this->image->store('public/images/projects');
            // remove public from the path as we need to store only the path in the db
            $image = str_replace('public/', '', $image);
        }else{
            $image = Helper::createAvatar($this->project_name,'projects');
        }

        // create a folder for the project

        $path = 'storage/'. session('org_name') . '/projects/' . $this->project_name;
        $path = public_path($path);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $this->client->projects()->create([
            'org_id' => $this->client->org_id,
            'client_id' => $this->client->id,
            'description' => $this->project_description,
            'name' => $this->project_name,
            'start_date' => $this->project_start_date,
            'due_date' => $this->project_due_date,
            'image' => $image,
        ]);

        $this->project_name = '';
        $this->project_due_date = '';

        $this->redirect(route('client.profile', $this->client_id),navigate:true);
    }

    public function updatedTeamId($team_id)
    {
        $this->team_id = $team_id;
        $team = Team::find($team_id);
        $this->users = $team->users;
        $this->dispatch('teamSelected', $team_id);
    }

}
