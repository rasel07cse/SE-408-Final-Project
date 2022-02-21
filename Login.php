
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <form>
        <div class="container">
        <h1>Login Here</h1>
        <hr>
        <label for="email"><b>Enter Email</b></label>
        <input id="pass-field" type="text" placeholder="Enter Email" name="email"><br><br>
        <label for="pwd"><b>Password</b></label>
        <input id="input-field" type="password" placeholder="Enter Password" name="pwd"><br>
        <hr>
        <button id="login-page" type="submit" name="login" class="registerbtn"><strong>Login</strong></button>
    
    </form>
    <style>
        form{
            text-align: center;
        }
        h1{
            text-align: center;
            color: green;
            background-color: lightgrey;
        }
        label{
            padding: 5 em;
        }
        button{
            color: green;
            text-align: center;
        }
    </style>

    <script src="login.js"></script>
</body>
</html>