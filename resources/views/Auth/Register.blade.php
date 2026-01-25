<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
        <h2>Register</h2>
    
    @if(isset($error))
        <p style="color: red;">{{ $error }}</p>
    @endif
    
    @if(isset($success))
        <p style="color: green;">{{ $success }}</p>
    @endif
    
    <form action="/auth/checkregister" method="post">
        @csrf
        <div>
            <label for="name">User Name:</label>
            <input type="text" name="name" placeholder="Enter User Name">
        </div>

        <br>

        <div>
            <label for="pass">Password:</label>
            <input type="password" name="pass" placeholder="Enter Password">
        </div>

        <br>

        <button type="submit">Register</button>
    </form>
</body>
</html>