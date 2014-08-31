<?php
/**
 * Created by IntelliJ IDEA.
 * User: xxvii27
 * Date: 8/30/14
 * Time: 8:37 PM
 */

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

function reloadUsers($username)
{
    printUser($username, 1);

    //Commence Query
    $queryUser = "SELECT * FROM members WHERE master = '$username'";

    $result = mysql_query($queryUser);

    while ($row = mysql_fetch_array($result)) {
        printUser($row['email'], $row['status']);
    }

}

connectDB();

$username = htmlentities(substr(urldecode(gpc("username")), 0, 1024));
$master = htmlentities(substr(urldecode(gpc("master")), 0, 1024));


mysql_query("DELETE FROM members WHERE email='$username'");

reloadUsers($master);



?>