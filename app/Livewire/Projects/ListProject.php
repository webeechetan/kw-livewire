<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use App\Models\User;
use Livewire\Attributes\Lazy;

class ListProject extends Component
{
    use WithPagination;

    public $query = '';
 
    public $sort = 'all';
    public $filter = 'all';
    public $byTeam = 'all';
    public $byUser = 'all'; 
    public $users;

    public function render()
    {
        $projects = Project::where('name','like','%'.$this->query.'%');
        
        if($this->filter == 'active'){
            $projects->where('status','active');
        }elseif($this->filter == 'archived'){
            $projects->onlyTrashed();
        }elseif($this->filter == 'completed'){
            $projects->where('status','completed');
        }elseif($this->filter == 'overdue'){
            $projects->where('status','overdue');
        }
        // dd($projects->toSql());
        if($this->sort == 'a_z'){
            $projects->orderBy('name');
        }elseif($this->sort == 'z_a'){
            $projects->orderByDesc('name');
        }elseif($this->sort == 'newest'){
            $projects->latest();
        }elseif($this->sort == 'oldest'){
            $projects->oldest();
        }

        if($this->byUser != 'all'){
            // select from project_user
            $projects->whereHas('users',function($query){
                $query->where('user_id',$this->byUser);
            });
        }

        $projects->orderBy('id','desc');

        $projects = $projects->paginate(15);

        return view('livewire.projects.list-project',[
            'projects' => $projects
        ]);
    }

    public function mount(){
        $this->users = User::all();
    }

    public function search(){
        $this->resetPage();
    }

    public function updatedByUser($value){
        $this->byUser = $value;
        $this->redirect(route('project.index',['sort'=>$this->sort,'filter'=>$this->filter,'byUser'=>$this->byUser,'byTeam'=>$this->byTeam]), navigate: true);
    }

    public function emitEditEvent($projectId)
    {
        $this->dispatch('editProject', $projectId);
    }

    public function emitDeleteEvent($projectId)
    {
        $this->dispatch('deleteProject', $projectId);
    }

    public function emitRestoreEvent($projectId)
    {
        $this->dispatch('restoreProject', $projectId);
    }

    public function emitForceDeleteEvent($projectId)
    {
        $this->dispatch('forceDeleteProject', $projectId);
    }

    // public function placeholder(){
    //     return view('placeholders.card');
    // }
}
