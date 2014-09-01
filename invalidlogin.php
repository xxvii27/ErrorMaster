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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</head>

<body>
<div class="container">
    <form class="form-signin" action="./php/login.php" method="POST" accept-charset="UTF-8">
        <h2>Please sign in</h2>
        <p style="color:red">Invalid email or password</p>
        <input type="email" class="form-control" placeholder="Email" id="username" name="username" maxlength="30" required autofocus>
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" maxlength="30" required>
        <select name="status">
            <option value="owner" selected="selected">Owner</option>
            <option value="member">Member</option>
        </select>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button style="margin-left: 25px" type= 'button' class='btn btn-default' data-toggle='modal' data-target='.bs-example-modal-sm'>Forgot your password?</button>
        </div>
        <div id='logbuttons'>
            <a class="btn btn-lg btn-primary" href="http://104.131.199.129:83/index.php">Go Home</a>
            <button class="btn btn-lg btn-primary" type="submit">Sign in</button>
        </div>
    </form>
</div> <!-- /container -->



<div class="modal fade bs-example-modal-sm" id="forgotDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="email"type="email" class="form-control" placeholder="Email" name="email" maxlength="31" required>
                    <button type="button" class="btn btn-primary" type="submit" id="forgotpass">Submit</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>