<?php

session_start();

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

    $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error() );
    $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error() );

}

function printUser($username, $status){

    echo "<tr>";
    print "<td> $username </td>";
    echo  "<td>0</td>";
    echo "<td>0</td>";
    echo "<td>";

    if($status)
        echo "<span class='staton'>Online";
    else
        echo "<span class='statoff'>Offline";

    echo"</span>" ;
    echo "<button type='button' class='btn btn-default pull-right delete'><span class='glyphicon glyphicon-minus'></span></a>";
    echo "<button type='button' class='btn btn-default pull-right edit'><span class='glyphicon glyphicon-cog'></span></a></td>";
    echo"</tr>";
}

function printOwner($username, $status){
    echo "<tr>";
    print "<td> $username </td>";
    echo  "<td>0</td>";
    echo "<td>0</td>";
    echo "<td>";

    if($status)
        echo "<span class='staton'>Online";
    else
        echo "<span class='statoff'>Offline";

    echo"</td>";
    echo"</tr>";
}

function printUserLog($username, $status, $accesstime){

    echo "<tr>";
    print "<td> $username </td>";

    echo "<td>";
    if(strcmp($status, "LOGIN") == 0)
        echo "<span class='staton'>Login";
    else
        echo "<span class='statoff'>Logout";

    echo"</span>" ;
    echo "</td>";

    print "<td> $accesstime </td>";

    echo"</tr>";
}

function printErrors($time, $count, $name, $severity){

    echo "<tr>";
    print "<td>$time </td>";
    print "<td>$count</td>";
    print "<td>$name</td>";
    print "<td>$severity</td>";
    echo"</tr>";

}

function reloadUsersByOption($username, $option)
{
    $result = mysql_query("SELECT * FROM user WHERE email = '$username'");
    
    $row = mysql_fetch_array($result);

    printOwner($username, $row['status']);

    //Commence Query
    if($username === "admin@errormaster.com")
        $queryUser = "SELECT * FROM user WHERE email <> '$username' ORDER BY $option";
    else
      $queryUser = "SELECT * FROM members WHERE master = '$username' ORDER BY $option";

    $result = mysql_query($queryUser);

    while ($row = mysql_fetch_array($result)) {
        printUser($row['email'], $row['status']);
    }

}

function reloadLogByOption($option){

    //Commence Query
    $queryUser = "SELECT * FROM useraccesslog ORDER BY $option";

    $result = mysql_query($queryUser);

    while ($row = mysql_fetch_array($result)) {
        printUserLog($row['email'], $row['accesstype'], $row['accesstime']);
    }

}


function reloadErrorsByOption($master, $option){
    //Commence Query

    if($option === "occured")
        $queryUser = "SELECT * FROM errors WHERE master='$master' ORDER BY $option DESC";
    else
    $queryUser = "SELECT * FROM errors WHERE master='$master' ORDER BY $option";

    $result = mysql_query($queryUser);

    while ($row = mysql_fetch_array($result)) {
        printErrors($row['occured'], 0, $row['name'], 0);
    }
}


connectDB();
$master = $_SESSION['name'];
$access = $_SESSION['access'];

$option = htmlentities(substr(urldecode(gpc("sort")),0,1024));
$type = $_SESSION['type'];


if($access !== "owner"){
    $result = mysql_query("SELECT * FROM members WHERE email='$username'");
    $row = mysql_fetch_array($result);
    $master= $row['master'];
}

if($option === "User")
    $sortby = "email";
else if($option === "Status")
    $sortby = "status";
else if($option === "Access Type")
    $sortby = "accesstype";
else if($option === "Timestamp")
    $sortby = "accesstime";
else if($option === "Name"){
    $sortby = "name";
    $type = 'errors';
}
else if($option === "Severity"){
    $sortby = "severity";
    $type = 'errors';
}
else if($option === "Count"){
    $sortby = "count";
    $type = 'errors';
}
else if($option === "Time"){
    $sortby = "occured";
    $type = 'errors';
}
else{
	echo "Yet to be implemented, after error collecting";
	exit();
}


if($type === "logs")
    reloadLogByOption($sortby);
else if($type === "errors")
    reloadErrorsByOption($master, $sortby);
else
    reloadUsersByOption($master, $sortby);

?>