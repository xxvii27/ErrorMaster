<?php
session_start();
$_SESSION['type'] = "users";
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
	echo  "<td></td>";
	echo "<td></td>";
	echo "<td>";

	if($status)
	    echo "<span class='staton'>Online";
	else
	    echo "<span class='statoff'>Offline";

	echo"</span>" ;
	echo "<button type='button' class='btn btn-default pull-right delete'><span class='glyphicon glyphicon-minus'></span></button>";
	echo "<button type='button' class='btn btn-default pull-right edit'><span class='glyphicon glyphicon-cog'></span></button></td>";
	echo"</tr>";
}


function printOwner($username, $status, $num_of_errors, $total_errors){
	echo "<tr>";
	print "<td> $username </td>";
	echo  "<td>$num_of_errors</td>";
	echo "<td>$total_errors</td>";
	echo "<td>";

	if($status)
	    echo "<span class='staton'>Online";
	else
	    echo "<span class='statoff'>Offline";

	echo"</td>";
	echo"</tr>";
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


    $result = mysql_query("SELECT * FROM user WHERE email = '$username'");
    
    $row = mysql_fetch_array($result);

    $resource = mysql_query("SELECT COUNT(*) FROM errors WHERE master ='$username' ");
    $total_errors = mysql_result($resource,0);
    $resource = mysql_query("SELECT COUNT(DISTINCT name) FROM errors WHERE master ='$username'");
    $type_of_errors = mysql_result($resource,0);

    printOwner($username, $row['status'], $type_of_errors, $total_errors);

    //Commence Query
    $queryUser = "SELECT * FROM members WHERE master = '$username'";

    $result = mysql_query($queryUser);

    while ($row = mysql_fetch_array($result)) {
        printUser($row['email'], $row['status']);
    }

}


connectDB();
$username = htmlentities(substr(urldecode(gpc("user")), 0, 1024));

reloadUsers($username);



?>