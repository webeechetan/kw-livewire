<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Helper;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Models\Client;
use App\Models\Pin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
    public $pinnedProjects = [];

    // public $projects= [];

    public $teams = [] ;
    public $clients = [] ;

    public $project_all_count =[]; 

    public $query = '';
 
    public $sort = 'all';
    public $filter = 'all';
    public $byTeam = 'all';
    public $byUser = 'all';
    public $byClient = 'all';
    public $users;

    public function render()
    {   
        $this->pinnedProjects = Pin::where('user_id', Auth::user()->id)->where('pinnable_type', 'App\Models\Project')->pluck('pinnable_id')->toArray();
        $role = Auth::user()->roles->first()->name;
        $projects = Project::userProjects($role)
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->query.'%')
                    ->orWhereHas('client', function ($query) {
                        $query->where('name', 'like', '%'.$this->query.'%')
                                ->orWhere('brand_name', 'like', '%'.$this->query.'%');
                    });
            });

        $projects = $projects->whereNotIn('client_id', [Auth::user()->organization->mainClient->id]);
        $projects = $projects->whereHas('client', function ($query) {
            $query->where('clients.deleted_at','=', null);
        });


        $this->allProjects =  Project::whereNotIn('client_id', [Auth::user()->organization->mainClient->id])
        ->whereHas('client', function ($query) {
            $query->where('clients.deleted_at','=', null);
        })->count();
        
        $this->activeProjects = Project::whereNotIn('client_id', [Auth::user()->organization->mainClient->id])
        ->whereHas('client', function ($query) {
            $query->where('clients.deleted_at','=', null);
        })->where('status','active')->count();

        $this->completedProjects = Project::whereNotIn('client_id', [Auth::user()->organization->mainClient->id])
        ->whereHas('client', function ($query) {
            $query->where('clients.deleted_at','=', null);
        })->where('status','completed')->count();
        
        $this->archivedProjects = Project::whereNotIn('client_id', [Auth::user()->organization->mainClient->id])
        ->whereHas('client', function ($query) {
            $query->where('clients.deleted_at','=', null);
        })->onlyTrashed()->count();


        $this->overdueProjects = Project::whereNotIn('client_id', [Auth::user()->organization->mainClient->id])
        ->whereHas('client', function ($query) {
            $query->where('clients.deleted_at','=', null);
        })->where('due_date','<', Carbon::today())->count();



        if($this->filter == 'active'){
            $projects->where('status','active');
        }elseif($this->filter == 'archived'){
            $projects->onlyTrashed();
        }elseif($this->filter == 'completed'){
            $projects->where('status','completed');
        }elseif($this->filter == 'overdue'){ 
            $projects->where('due_date','<', Carbon::today());
        }

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
            $user = User::with('projects')->find($this->byUser);
            $projectIds = $user->projects->pluck('project_id')->toArray();
            $projects->whereIn('id', $projectIds);
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

        $this->project_all_count =  Project::all();
        $this->users = User::all();
        $this->clients = Client::all();
        $this->teams = Team::orderBy('name')->get();

        $tour = session()->get('tour');
        if(request()->tour == 'close-project-tour'){
            // $tour['project_tour'] = false;
            unset($tour['project_tour']);
            session()->put('tour',$tour);
        }

    }

    public function search(){
        $this->resetPage();
    }

    // public function updatedByClient($value){
    //     $this->byUser = $value;
    //     $this->redirect(route('project.index',['sort'=>$this->sort,'filter'=>$this->filter,'byClient'=>$this->byClient,'byUser'=>$this->byUser]), navigate: true);
    // }

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

        if($this->byTeam != 'all' || $this->byUser != 'all' || $this->byClient != 'all' || $this->sort != 'all' || $this->filter != 'all'){
            return true;
        }
        return false;
    }


    // public function placeholder(){
    //     return view('placeholders.card');
    // }
}