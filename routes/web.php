<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\ForgotPassword;
use App\Livewire\Dashboard;
use App\Livewire\Clients\AddClient;
use App\Livewire\Clients\ListClient;
use App\Livewire\Clients\EditClient;
use App\Livewire\Clients\Client as ClientProfile;
use App\Livewire\Projects\AddProject;
use App\Livewire\Projects\ListProject;
use App\Livewire\Projects\EditProject;
use App\Livewire\Users\AddUser;
use App\Livewire\Users\ListUser;
use App\Livewire\Teams\AddTeam;
use App\Livewire\Teams\ListTeam;
use App\Livewire\Teams\EditTeam;
use App\Livewire\Tasks\AddTask;
use App\Livewire\Tasks\ListTask;
use App\Livewire\Tasks\TaskListView;
use App\Livewire\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\User;
use App\Models\Scopes\OrganizationScope;
use App\Notifications\InviteUser;


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

Route::get('/create-image',function(){
    // Avatar::create('Susilo Bambang Yudhoyono')->save('sample.png');
    // save in storage folder
    Avatar::create('Susilo Bambang Yudhoyono')->save(storage_path('app/public/sample.png'));
});

Route::get('/',Login::class);
Route::get('/login',Login::class)->name('login');
Route::get('/register/{org_id?}',Register::class)->name('register');

Route::get('/forgot-password',ForgotPassword::class)->name('forgot.password')->middleware('throttle:5,1');

Route::group(['middleware' => ['myauth']], function() {

    Route::get('/dashboard',Dashboard::class)->name('dashboard');
    
    Route::get('/clients',ListClient::class)->name('client.index');
    Route::get('/clients/add',AddClient::class)->name('client.add');
    Route::get('/clients/edit/{id}',EditClient::class)->name('client.edit');
    Route::get('/client/view/{id}',ClientProfile::class)->name('client.profile');
    
    Route::get('/projects',ListProject::class)->name('project.index');
    Route::get('/projects/add',AddProject::class)->name('project.add');
    Route::get('/projects/edit/{id}',EditProject::class)->name('project.edit');
    
    Route::get('/teams',ListTeam::class)->name('team.index');
    Route::get('/teams/add',AddTeam::class)->name('team.add');
    Route::get('/teams/edit/{id}',EditTeam::class)->name('team.edit');

    Route::get('/users',ListUser::class)->name('user.index');
    Route::get('/users/add',AddUser::class)->name('user.add');
    
    
    Route::get('/tasks',ListTask::class)->name('task.index');
    Route::get('/tasks/add',AddTask::class)->name('task.add');
    Route::get('/tasks/list-view',TaskListView::class)->name('task.list-view');

    Route::get('/file-manager',FileManager::class)->name('file-manager');
    
    Route::get('/logout',function(){
        Auth::logout();
        return redirect(route('login'));
    })->name('logout');
});


// factory routes

// create 100 clients

Route::get('/create-clients',function(){
    Client::factory()->count(10000)->create();
})->name('create-clients');


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