<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 9/2/14
 * Time: 3:07 PM
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

function printErrors($time, $count, $name, $severity){

    echo "<tr>";
    print "<td>$time </td>";
    print "<td>$count</td>";
    print "<td>$name</td>";
    print "<td>$severity</td>";
    echo"</tr>";

}

function reloadErrors($username, $summary){
    //Commence Query
    $queryErrors = "SELECT * FROM errors WHERE master = '$username'";


    if($summary === "yes"){
        $x = 0;
        $result = mysql_query($queryErrors);
        while ($row = mysql_fetch_array($result) && $x < 10) {
            printErrors($row['occured'], 0, $row['name'], 0);
            $x++;
        }
    }
    else{
        $result = mysql_query($queryErrors);
        while ($row = mysql_fetch_array($result)) {
            printErrors($row['occured'], 0, $row['name'], 0);
        }
    }

}

connectDB();

$username = htmlentities(substr(urldecode(gpc("user")), 0, 1024));
$summary = htmlentities(substr(urldecode(gpc("summary")), 0, 1024));


if($access === "owner")
    reloadErrors($username, $summary);
else{
    $result = mysql_query("SELECT * FROM members WHERE email='$username'");
    $row = mysql_fetch_array($result);
    $master= $row['master'];
    reloadErrors($master, $summary);
}
