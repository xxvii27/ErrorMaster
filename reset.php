<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 9/1/14
 * Time: 11:50 AM
 */

session_start();

$email = $_SESSION['email'];
if($email === null){
    http_response_code(403);
    header('Location: http://104.131.199.129:83/error/forbidden403.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Your Mother">
    <link rel="icon" href="../../favicon.ico"> <!-- ADD A FAVICON HEERE -->

    <title>Reset Password</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</head>

<body>
<div class="container">
    <form class="form-signin" action="./resetted.php" method="POST" accept-charset="UTF-8">
        <h2>Please enter new password</h2>
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" maxlength="30" required>
        <div id='logbuttons'>
            <button class="btn btn-lg btn-primary" type="submit">Reset</button>
        </div>
    </form>
</div> <!-- /container -->


