<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Your Mother">
    <link rel="icon" href="../../favicon.ico"> <!-- ADD A FAVICON HEERE -->

    <title>Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">

</head>

<body>
<div class="container">
    <form class="form-signin" action="./php/login.php" method="POST" accept-charset="UTF-8">
        <h2>Please sign in</h2>
        <p style="color:red">Invalid email or password</p>
        <input type="email" class="form-control" placeholder="Email" id="username" name="username" maxlength="30" required autofocus>
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" maxlength="30" required>
        <select name="status" required>
            <option value="owner" selected="selected">Owner</option>
            <option value="member">Member</option>
        </select>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <a style="margin-left: 25px" rel="nofollow" href="#recovery">Forgot your password?</a>
        </div>
        <div id='logbuttons'>
            <a class="btn btn-lg btn-primary" href="http://104.131.199.129:83/index.php">Go Home</a>
            <button class="btn btn-lg btn-primary" type="submit">Sign in</button>
        </div>
    </form>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>