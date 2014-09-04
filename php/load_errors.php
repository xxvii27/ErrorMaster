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

function printErrors($time, $name){

    echo "<tr>";
    print "<td>$time </td>";
    print "<td><a href='#err' class='errLink'>$name</a></td>";
    echo"</tr>";

}

function reloadErrors($username, $summary){
    //Commence Query


    if($summary === "yes"){
        $queryErrors = "SELECT * FROM errors WHERE master = '$username' ORDER BY occured DESC LIMIT 5";
        $resource = mysql_query("SELECT COUNT(*) FROM errors WHERE master ='$username' ");
        $total_errors = mysql_result($resource,0);
        $resource = mysql_query("SELECT COUNT(DISTINCT name) FROM errors WHERE master ='$username'");
        $type_of_errors = mysql_result($resource,0);
        echo "You Have : ". $total_errors . "Errors, There are ". $type_of_errors. "types";
    }
    else{
        $queryErrors = "SELECT * FROM errors WHERE master = '$username'";
    }

    $result = mysql_query($queryErrors);
    while ($row = mysql_fetch_array($result)) {
        printErrors($row['occured'], $row['name']);
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
