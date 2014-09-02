<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 9/1/14
 * Time: 12:04 PM
 */

session_start();

//Database Connection
function connectDB (){
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'userinfo');
    define('DB_USER','root');
    define('DB_PASSWORD','ohanajumba');

    $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
    $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

}

connectDB();

$email = $_SESSION['email'];
$access = $_SESSION["status"];

if($email === null){
    http_response_code(403);
    header('Location: http://104.131.199.129:83/error/forbidden403.html');
    exit();
}

$password =mysql_real_escape_string($_POST['password']);

$password = hash("sha512", $password);

if($access === "owner")
    $command = "UPDATE user SET password='$password' WHERE email='$email'";
else
    $command = "UPDATE members SET password='$password' WHERE email='$email'";

mysql_query($command);


session_destroy();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Your Mother">
    <link rel="icon" href="../../favicon.ico"> <!-- ADD A FAVICON HEERE -->

    <title>Resetted</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">

</head>

<body>
<div class="container">
    <h1 class="page-header">Pasword resetted  !!!!</h1>
    <br/>
    <a class="btn btn-lg btn-primary" href="http://104.131.199.129:83/index.php">Login</a>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>