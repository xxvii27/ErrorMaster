<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 9/1/14
 * Time: 11:13 AM
 */

session_start();

$email = $_POST['email'];

$_SESSION['email'] = $email;

$to      = $email;
$subject = 'Reset Password';
$message = "To reset password please go to the following link: http://104.131.199.129:83/reset.php";
$headers = 'From: admin@errormaster.com' . "\r\n" .
    'Reply-To: admin@errormaster.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Your Mother">
    <link rel="icon" href="../../favicon.ico"> <!-- ADD A FAVICON HEERE -->

    <title>Reset</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">

</head>

<body>
<div class="container">
    <h1 class="page-header">Password Reset link have been sent to your Email !!!</h1>
    <br/>
    <a class="btn btn-lg btn-primary" href="http://104.131.199.129:83/index.php">Login</a>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>