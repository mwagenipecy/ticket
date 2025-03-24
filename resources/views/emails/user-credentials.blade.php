<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account Credentials</title>
</head>
<body>
<h1>Hello, {{ $user->name }}</h1>
<p>Your account has been successfully created. Here are your login credentials:</p>

<ul>
    <li><strong>Email:</strong> {{ $user->email }}</li>
    <li><strong>Password:</strong> {{ $password }}</li>
</ul>

<p>Regards,<br>Umoja Ticketing System</p>
</body>
</html>
