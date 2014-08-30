<?php

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
	echo "<button type='button' class='btn btn-default pull-right'><span class='glyphicon glyphicon-minus'></span></a>";
	echo "<button type='button' class='btn btn-default pull-right'><span class='glyphicon glyphicon-cog'></span></a></td>";
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

connectDB();

$username = htmlentities(substr(urldecode(gpc("user")),0,1024));
$status = 1;

printUser($username, $status);

//Commence Query







?>