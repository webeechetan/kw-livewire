@php
    $id = request()->route('task');
    $task = App\Models\Task::withoutGlobalScope(
        \App\Models\Scopes\OrganizationScope::class
    )->find($id);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--- Meta Tag for SEO --->
    <meta name="description" content="Login to review the task on the web app">
    <meta name="keywords" content="Kaykewalk, Team Management, Client Management">
    <meta name="author" content="Kaykewalk">

    <!--- Favicon --->
    <link rel="icon" href="{{ asset('') }}assets/images/fav.png" />

    <!---- Open Graph Meta Tags --->
    <meta property="og:title" content="Login to review the task on the web app">
    <meta property="og:description" content="Login to review the task on the web app">
    <meta property="og:image" content="{{ asset('') }}assets/images/fav.png">
    <meta property="og:url" content="{{ route('login') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:site_name" content="Kaykewalk">
    <meta name="twitter:image:alt" content="Login to review the task on the web app">
    

    <!--- Title --->

    <title>@if($task){{ $task->name }}@else Requested route not found  @endif</title>

</head>
<body>
    <h1>404 Not Found</h1>
    <p>Sorry, the page you are looking for could not be found.</p>
    <p>
        Please login to access the page you are looking for.
    </p>    
    <a href="{{ route('login') }}">Login</a>

</body>
</html>