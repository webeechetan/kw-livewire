<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Helper;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Models\Client;
use Carbon\Carbon;
use Livewire\Attributes\Lazy;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class ListProject extends Component
{
    use WithPagination;


    public $allProjects;
    public $activeProjects;
    public $completedProjects;
    public $archivedProjects;
    public $overdueProjects;


    public $teams = [] ;
    public $clients = [] ;

    public $query = '';
 
    public $sort = 'all';
    public $filter = 'all';
    public $byTeam = 'all';
    public $byUser = 'all';
    public $byClient = 'all';
    public $users;

    public function render()
    {
        $this->allProjects = Project::count();

        $this->activeProjects = Project::where('status', 'active')->count();
        $this->completedProjects = Project::where('status', 'completed')->count();
        $this->archivedProjects = Project::onlyTrashed()->count();
        //$this->overdueProjects = Project::where('status', 'overdue')->count();
        $this->overdueProjects = Project::where('due_date', '<', Carbon::today())->count();
        
        $projects = Project::where('name','like','%'.$this->query.'%')
                    ->whereHas('client',function($query){
                        $query->where('deleted_at','IS NOT NULL');
                    })->orWhereHas('client',function($query){
                        $query->where('name','like','%'.$this->query.'%')->orWhere('brand_name','like','%'.$this->query.'%');
                    });
        // dd($projects->toSql());

        if($this->filter == 'active'){
            $projects->where('status','active');
        }elseif($this->filter == 'archived'){
            $projects->onlyTrashed();
        }elseif($this->filter == 'completed'){
            $projects->where('status','completed');
        }elseif($this->filter == 'overdue'){ 
            $projects->where('due_date','<', Carbon::today());
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

        if($this->byClient != 'all'){
            $projects->whereHas('client',function($query){
                $query->where('client_id',$this->byClient);
            });
        }

      

        if($this->byUser != 'all'){
            $user = User::find($this->byUser);
            if($user){
                $projectsIds = $user->projects->pluck('id')->toArray();
                $projects->whereIn('id',$projectsIds);
            }
        }
       

        if ($this->byTeam != 'all') {
            $team = Team::find($this->byTeam);
            if ($team) {
                $projectIds = $team->projects->pluck('id')->toArray();
                $projects->whereIn('id', $projectIds);
            }
        }


        $projects->orderBy('id','desc');
        $projects = $projects->paginate(12);

        return view('livewire.projects.list-project',[
            'projects' => $projects
        ]);
    }

    public function mount(){
        
        $this->authorize('View Project');
        $this->users = User::all();
        $this->clients = Client::all();
        $this->teams = Team::orderBy('name')->get();
    }

    public function search(){
        $this->resetPage();
    }

    // public function updatedByClient($value){
    //     $this->byUser = $value;
    //     $this->redirect(route('project.index',['sort'=>$this->sort,'filter'=>$this->filter,'byClient'=>$this->byClient,'byUser'=>$this->byUser]), navigate: true);
    // }

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

    public function doesAnyFilterApplied(){
        return $this->byTeam != 'all' || $this->byUser != 'all' || $this->byClient != 'all' || $this->sort != 'all' || $this->filter != 'all';
    }


  

    // public function placeholder(){
    //     return view('placeholders.card');
    // }
}
