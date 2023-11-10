<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\Clients\AddClient;
use App\Livewire\Clients\ListClient;
use App\Livewire\Projects\AddProject;
use App\Livewire\Projects\ListProject;
use App\Livewire\Users\AddUser;
use App\Livewire\Users\ListUser;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;


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

Route::get('/login',Login::class)->name('login');
Route::get('/register',Register::class)->name('register');

Route::get('/dashboard',Dashboard::class)->name('dashboard');

Route::get('/clients',ListClient::class)->name('client.index');
Route::get('/clients/add',AddClient::class)->name('client.add');

Route::get('/projects',ListProject::class)->name('project.index');
Route::get('/projects/add',AddProject::class)->name('project.add');

Route::get('/users',ListUser::class)->name('user.index');
Route::get('/users/add',AddUser::class)->name('user.add');



Route::get('/logout',function(){
    Auth::logout();
    return redirect(route('login'));
})->name('logout');

// factory routes

// create 100 clients

Route::get('/create-clients',function(){
    Client::factory()->count(10000)->create();
})->name('create-clients');


