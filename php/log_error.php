<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 9/2/14
 * Time: 12:30 PM
 */


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

//Database Connection
function connectDB (){
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'userinfo');
    define('DB_USER','root');
    define('DB_PASSWORD','ohanajumba');

    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD, DB_NAME) or die("Failed to connect to MySQL: " . mysql_error() );

    return $con;
}


function logError($occured, $name, $line, $master, $url, $db){

    mysqli_real_escape_string($db, $name);
    $command="INSERT INTO errors (id, occured, name, url, line, master) VALUES (NULL, '$occured', '$name', '$url','$line', '$master')";
    mysqli_query($db, $command) or die(mysqli_error($db));
}


$db = connectDB();

$message = htmlentities(substr(urldecode(gpc("msg")),0,1024));
$url = htmlentities(substr(urldecode(gpc("url")),0,1024));
$line = htmlentities(substr(urldecode(gpc("line")),0,1024));
$master = htmlentities(substr(urldecode(gpc("master")),0,1024));

$date = date('Y-m-d G:i:s', time());

logError($date, $message, $line, $master, $url, $db);


mysqli_close($db);
