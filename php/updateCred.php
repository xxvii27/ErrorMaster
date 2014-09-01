<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 9/1/14
 * Time: 3:14 PM
 */

session_start();

$name = $_SESSION['name'];
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

connectDB();

$option = htmlentities(substr(urldecode(gpc("update")),0,1024));

if($option === "pass"){
    $newpass = htmlentities(substr(urldecode(gpc("password")),0,1024));
    $newpass = hash("sha512", $newpass);
    if($access == "owner"){
        mysql_query("UPDATE user SET password='$newpass' WHERE email='$name'");
    }
    else{
        mysql_query("UPDATE members SET password='$newpass' WHERE email='$name'");
    }

}
else{
    $newcode = htmlentities(substr(urldecode(gpc("code")),0,1024));
    $newcode = intval($newcode);
    mysql_query("UPDATE user SET code=$newcode WHERE email='$name'");
}