<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Hi {{ $user->name }},
    <br>
    <br>
    Your account has been created successfully.
    <br>
    <br>
    Your login credentials are as follows:
    <br>
    <br>
    Email: {{ $user->email }}
    <br>
    Password: {{ $password }}
    <br>
    <br>
    Please login to your account and change your password.
    <br>
    <br>
    
</body>
</html>