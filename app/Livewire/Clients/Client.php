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
    public $team_users = [];
    




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

    public function assignTeam(){
        if($this->team_id == ''){
            return;
        }

        // dd($this->team_id);

        // restrict the team from being assigned to the client more than once
        if($this->client->teams->contains($this->team_id)){
            $this->dispatch('error', 'Team already assigned to the client.');
            return;
        }

        // restrict the user from being assigned to the client more than once

        $this->team_users = array_unique($this->team_users);
        $this->team_users = array_diff($this->team_users, $this->client->users->pluck('id')->toArray());

        if(count($this->team_users) == 0){
            $this->dispatch('error', 'No new users to assign to the client.');
            return;
        }

        $this->client->teams()->attach($this->team_id);

        // $this->client->users()->attach($this->team_users);

        foreach($this->team_users as $user){
            $this->client->users()->attach($user, ['team_id' => $this->team_id]);
        }

        $this->team_users = [];
        $this->team_id = '';
        $this->dispatch('success', 'Team assigned to the client successfully.');
        $this->dispatch('teamAssigned', $this->team_id);
    }

    public function editTeam($id){
        $this->team_id = $id;
        $this->team_users = [];
        $this->team_users = $this->client->users->where('pivot.team_id', $id)->pluck('id')->toArray();
        // dd($this->team_users);
        $team = Team::find($id);
        $this->users = $team->users;
        $this->dispatch('teamSelectedForEdit', $this->team_users);
        // $this->team_users = [];
    }

    public function updateTeam(){
        if($this->team_id == ''){
            return;
        }
        
        // sync the users with client with the team id



        foreach($this->team_users as $user){
            $this->client->users()->detach($user, ['team_id' => $this->team_id]);

            $this->client->users()->attach($user, ['team_id' => $this->team_id]);
        }

        $this->team_users = [];

        $this->team_id = '';

        $this->dispatch('success', 'Team updated successfully.');
        $this->dispatch('teamUpdated', $this->team_id);
    }

}
