<?php

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



function loadError($username, $errorname, $time){
    //Commence Query


    $queryErrors = "SELECT * FROM errors WHERE master = '$username' AND name = '$errorname' AND occured ='$time'";


    $result = mysql_query($queryErrors);
    while ($row = mysql_fetch_array($result)) {
        echo $row['name'] . " " . $row['url'] . " " . $row['line'];
    }
}

connectDB();

$username = htmlentities(substr(urldecode(gpc("user")), 0, 1024));
$errorname = htmlentities(substr(urldecode(gpc("errorname")), 0, 1024));
$time = htmlentities(substr(urldecode(gpc("time")), 0, 1024));


if($access === "owner"){
    loadError($username, $errorname, $time);
    echo "test";
}
else{
    $result = mysql_query("SELECT * FROM members WHERE email='$username'");
    $row = mysql_fetch_array($result);
    $master= $row['master'];
    loadError($username, $errorname, $time);
    echo "test";
}
