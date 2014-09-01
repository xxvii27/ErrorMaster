<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 9/1/14
 * Time: 11:13 AM
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

$email = $_POST['email'];

$access = $_POST["status"];


$_SESSION['email'] = $email;
$_SESSION['status'] = $access;

if($email === null){
    http_response_code(403);
    header('Location: http://104.131.199.129:83/error/forbidden403.html');
    exit();
}

if($access === "owner")
    $command = "SELECT * FROM user WHERE email='$email'";
else
    $command = "SELECT * FROM members WHERE email='$email'";

$result = mssql_query($command);

if(mysql_fetch_array($result) === 0 ){
    header('Location: http://104.131.199.129:83/notfounduser.html');
}

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
    <h1 class="page-header">Enter your secret team code</h1>
    <form class="form-signin" action="./reset.php" method="POST" accept-charset="UTF-8">
        <h2>Please enter the code</h2>
        <input type="password" class="form-control" placeholder="Secret Code" id="password" name="code" maxlength="30" required>
        <div id='logbuttons'>
            <button class="btn btn-lg btn-primary" type="submit">Reset</button>
        </div>
    </form>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>