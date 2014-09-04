<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 9/3/14
 * Time: 3:57 PM
 */


session_start();

$access = $_SESSION['access'];

//Database Connection
function connectDB (){
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'userinfo');
    define('DB_USER','root');
    define('DB_PASSWORD','ohanajumba');

    $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error() );
    $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error() );

}

/* Helper functions */
function gpc($name)
{
    if (isset($_GET[$name]))
        return $_GET[$name];
    else if (isset($_POST[$name]))
        return $_POST[$name];
    else if (isset($_COOKIE[$name]))
        return $_COOKIE[$name];
    else
        return "";
}


function insertComment($username, $comment, $time, $errorname, $master){

    $command = "SELECT * FROM errors WHERE master = '$master' AND name='$errorname' AND occured ='$time'";
    $result = mysql_query($command);
    $row = mysql_fetch_array($result);
    $err_id = $row['id'];
    echo $err_id;
    $command = "INSERT INTO errorComments (id, name, comment, err_id) VALUES (NULL, '$username' '$comment', $err_id)";
    mysql_query($command);

    return $err_id;

}

function reloadComments($err_id){

       $command = "SELECT * FROM errorComments WHERE err_id = $err_id";
       $result =  mysql_query($command);

       while($row = mysql_fetch_array($result)){
           echo "<h5>".$row['name']."</h5>";
           echo "<p>".$row['comment']."</p>";
       }
}



connectDB();

$username = htmlentities(substr(urldecode(gpc("username")), 0, 1024));
$comment = htmlentities(substr(urldecode(gpc("comment")), 0, 1024));
$time = htmlentities(substr(urldecode(gpc("time")), 0, 1024));
$errorname = htmlentities(substr(urldecode(gpc("errorname")), 0, 1024));



if($access === "owner")
    reloadComments(insertComment($username, $comment, $time, $errorname, $username));
else{
    $result = mysql_query("SELECT * FROM members WHERE email='$username'");
    $row = mysql_fetch_array($result);
    $master= $row['master'];
    reloadComments(insertComment($username, $comment, $time, $errorname, $master));
}