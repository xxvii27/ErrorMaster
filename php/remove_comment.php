<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 9/3/14
 * Time: 3:57 PM
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


function getErrID($time, $errorname, $master){

    $command = "SELECT * FROM errors WHERE master = '$master' AND name='$errorname' AND occured ='$time'";
    $result = mysql_query($command);
    $row = mysql_fetch_array($result);
    $err_id = $row['id'];

    return $err_id;

}

function reloadComments($err_id){

    $command = "SELECT * FROM errorComments WHERE err_id = $err_id";
    $result =  mysql_query($command);

    while($row = mysql_fetch_array($result)){
        echo "<h5>".$row['name']."</h5>";
        echo "<span class='pull-right'>";
        switch($row['rating']){
            case 5: echo"<span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span>";
                break;
            case 4: echo"<span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span>";
                break;
            case 3:echo"<span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span>";
                break;
            case 2:echo"<span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span>";
                break;
            case 1: echo"<span class='glyphicon glyphicon-star'></span>";
                break;
            default:
                echo"<h5>No Rating</h5>";
        }
        echo "</span>";
        echo "<p>".$row['comment']."</p>";
        echo "<button class='btn btn-xs btn-danger glyphicon glyphicon-trash text-right rmComment'></button>";
        echo "<br/><br/>";
    }
}

function removeComments($username, $comment){

    mysql_query("DELETE FROM errorComments WHERE name='$username' AND comment='$comment'") or die(mysql_error());

}


connectDB();

$username = htmlentities(substr(urldecode(gpc("user")), 0, 1024));
$comment = htmlentities(substr(urldecode(gpc("comment")), 0, 1024));
$errorname = mysql_real_escape_string(htmlentities(substr(urldecode(gpc("errorname")), 0, 1024)));
$time = htmlentities(substr(urldecode(gpc("time")), 0, 1024));


if($access === "owner"){
    removeComments($username, $comment);
    reloadComments(getErrID($time, $errorname, $username));
}
else{
    echo("<b>You Don't have the permission to remove comments</b>");
}