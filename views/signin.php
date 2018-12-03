<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signin page for TaskManager</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/styles/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form action="/login" method="post" class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputLogin" class="sr-only">Your Login</label>
    <input id="inputLogin" name="username" class="form-control" placeholder="Enter login" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>
    <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Sign in">
</form>
</body>
</html>