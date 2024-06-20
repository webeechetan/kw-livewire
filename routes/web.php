<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\ForgotPassword;
use App\Livewire\Dashboard;

use App\Livewire\Clients\AddClient;
use App\Livewire\Clients\ListClient;
use App\Livewire\Clients\EditClient;
use App\Livewire\Clients\Client as ClientProfile;
use App\Livewire\Clients\Components\FileManager as ClientFileManager;
use App\Livewire\Clients\Components\Projects as ClientProjects;


use App\Livewire\Projects\ListProject;
use App\Livewire\Projects\Project;
use App\Livewire\Projects\Components\Tasks as ProjectTasks;
use App\Livewire\Projects\Components\FileManager as ProjectFileManager;

use App\Livewire\Users\AddUser;
use App\Livewire\Users\ListUser;
use App\Livewire\Users\User as UserProfile;

// Teams Route
use App\Livewire\Teams\ListTeam;
use App\Livewire\Teams\Team as TeamProfile;
use App\Livewire\Teams\Components\Projects as TeamProjects;
use App\Livewire\Teams\Components\Tasks as TeamTasks;

use App\Livewire\Tasks\AddTask;
use App\Livewire\Tasks\ListTask;
use App\Livewire\Tasks\TaskListView;
use App\Livewire\Tasks\View;
use App\Livewire\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\User;
use App\Models\Scopes\OrganizationScope;
use App\Notifications\InviteUser;

// Role and Permission

use App\Livewire\Roles\ListRole;
use App\Livewire\Roles\RoleView;
use App\Models\Task;
use Spatie\Permission\Models\Role;

// OrganizationActivities

use App\Livewire\Activity\ListActivity;
use App\Livewire\Activity\Activity;
use App\Livewire\Activity\Components\ActivityTabs;
use App\Livewire\Activity\Components\Tasks as ActivityTasks;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',Login::class);
Route::get('/login',Login::class)->name('login');
Route::get('/register/{org_id?}',Register::class)->name('register');
Route::get('/logout',function(){
    Auth::logout();
    return redirect(route('login'));
})->name('logout');

Route::get('/forgot-password',ForgotPassword::class)->name('forgot.password')->middleware('throttle:5,1');

Route::group(['middleware' => ['myauth']], function() {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard',Dashboard::class)->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | OrganizationActivities Routes
    |--------------------------------------------------------------------------
    */
 
    Route::get('/activities',ListActivity::class)->name('activity.index');
    Route::get('/activity/view/{organizationActivity}',Activity::class)->name('activity.profile');
    Route::get('/activity/view/{organizationActivity}/tasks',ActivityTasks::class)->name('activity.tasks')->withTrashed();



    /*
    |--------------------------------------------------------------------------
    | Client Routes
    |--------------------------------------------------------------------------
    */
    
    Route::get('/clients/{sort?}/{filter?}',ListClient::class)->name('client.index');
    Route::get('/client/view/{id}',ClientProfile::class)->name('client.profile');
    Route::get('/client/view/{id?}/projects',ClientProjects::class)->name('client.projects');
    Route::get('/client/view/{id?}/file-manager',ClientFileManager::class)->name('client.file-manager');

    /*
    |--------------------------------------------------------------------------
    | Project Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/projects/{sort?}/{filter?}/{byUser?}/{byTeam?}',ListProject::class)->name('project.index');
    Route::get('/project/view/{id}',Project::class)->name('project.profile');
    Route::get('/project/view/{project}/tasks',ProjectTasks::class)->name('project.tasks')->withTrashed();
    Route::get('/project/view/{project}/file-manager',ProjectFileManager::class)->name('project.file-manager')->withTrashed();
    
    /*
    |--------------------------------------------------------------------------
    | Teams Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/teams/{sort?}/{filter?/{byUser?}',ListTeam::class)->name('team.index');
    Route::get('/team/view/{team}',TeamProfile::class)->name('team.profile');
    Route::get('/team/view/{team?}/projects',TeamProjects::class)->name('team.projects');
    Route::get('/team/view/{team?}/tasks/{status?}',TeamTasks::class)->name('team.tasks');

    /*
    |--------------------------------------------------------------------------
    | Users Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/users/{sort?}/{filter?}/{byProject?}',ListUser::class)->name('user.index');
    Route::get('/users/add',AddUser::class)->name('user.add');
    Route::get('/user/view/{user_id?}',UserProfile::class)->name('user.profile');

    /*
    |--------------------------------------------------------------------------
    | Task Routes
    |--------------------------------------------------------------------------
    */
    
    Route::get('/tasks/list-view',TaskListView::class)->name('task.list-view');
    Route::get('/tasks/{sort?}/{filter?}/{byProject?}/{byClient?}',ListTask::class)->name('task.index');
    Route::get('/tasks/add',AddTask::class)->name('task.add');
    Route::get('/task/view/{task}',View::class)->name('task.view');

    /*
    |--------------------------------------------------------------------------
    | Role and permisison Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/roles',ListRole::class)->name('role.index');
    Route::get('/role/{role}', RoleView::class)->name('role.profile');

    /*
    |--------------------------------------------------------------------------
    | Logout & others Routes
    |--------------------------------------------------------------------------
    */
    
    Route::get('/logout',function(){
        Auth::logout();
        return redirect(route('login'));
    })->name('logout');

});

// notification  view testing

Route::get('/invite-mail',function(){
    // $user = User::withoutGlobalScope(OrganizationScope::class)->first();
    // $user->notify(new InviteUser());
    // return 'Notification sent';
    return view('mails.invite-mail',[
        'user' => User::withoutGlobalScope(OrganizationScope::class)->first()
    ]);
});

Route::get('/forgot-password-mail',function(){
    return view('mails.forgot-password-mail',[
        'user' => User::withoutGlobalScope(OrganizationScope::class)->first()
    ]);
});

Route::get('/new-user-mail',function(){
    return view('mails.new-user-mail',[
        'user' => User::withoutGlobalScope(OrganizationScope::class)->first()
    ]);
});


// New route created for emailer by ajay on 8 april-24

Route::get('/user-new-user',function(){
  
     return view('mails.user-new-user');
   
});


Route::get('/user-permission',function(){
  
     return view('mails.user-permission-mail');
     
});
// Himanshu Created This Route
Route::get('/task-assigned-notification',function(){
  
    return view('mails.task-assigned-notification-mail');
    
});
Route::get('/task-notifier-notification',function(){
  
    return view('mails.task-notifier-notification-mail');
    
});
Route::get('/task-mention-notification',function(){
  
    return view('mails.task-mention-notification-mail');
    
});
Route::get('/comment-notification',function(){
  
    return view('mails.comment-notification-mail');
    
});
Route::get('/comment-notification',function(){
  
    return view('mails.comment-notification-mail');
    
});

Route::get('/create-password',function(){
  
   dd(Hash::make(123456));
    
});

// Route::get('/roles/view', function(){
//     return view('roles.role-view');
// });





