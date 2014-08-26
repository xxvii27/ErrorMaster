<?php session_start();  ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Your Mother">
    <link rel="icon" href="../../favicon.ico"> <!-- ADD A FAVICON HEERE -->

    <title>Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
    <link href="/css/bootstrap_login.css" rel="stylesheet">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">

  </head>

  <body>

    <h1 style="text-align: center">Error Master</h1>


    <!-- THIS IS THE LOGIN MODULE CODE -->
    <div class="login">
      <form class="form-signin" action="/php/login.php" role="form"
            method="POST" accept-charset="UTF-8">
        <h2 class="form-signin-heading">Please sign in</h2>
        <p style="color:red"> Please provide a valid username and password </p>
        <input type="email" class="form-control" placeholder="Email"
              name="username" maxlength="30" required autofocus>
        <input type="password" class="form-control" placeholder="Password"
              id="password" name="password" maxlength="30" required>
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        <a style="margin-left: 25px" rel="nofollow"
              href="#recovery">Forgot your password?</a>
        <a href="http://104.131.199.129:82/index.php" class="btn btn-lg btn-primary">Home</a>
        <button class="btn btn-lg btn-primary" type="submit">Sign in</button>
      </form>
    </div>

  </body>
</html>
