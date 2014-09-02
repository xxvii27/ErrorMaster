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


function printErrors($time, $count, $name, $severity){

    echo "<tr>";
    print "<td>$time </td>";
    echo "<td>$count</td>";
    echo "<td>$name</td>";
    echo "<td>$severity</td>";
    echo"</tr>";

}

function reloadErrors($username){
    //Commence Query
    $queryErrors = "SELECT * FROM errors WHERE master = '$username'";

    $result = mysql_query($queryErrors);

    while ($row = mysql_fetch_array($result)) {
        printUser($row['occured'], 0, $row['name'], 0);
    }

}

connectDB();

$username = htmlentities(substr(urldecode(gpc("user")), 0, 1024));

if($access == 'owner')
    reloadErrors($username);
else{
    $result = mysql_query("SELECT * FROM members WHERE email='$username'");
    $row = mysql_fetch_array($result);
    $master= $row['master'];
    reloadErrors($master);
}
