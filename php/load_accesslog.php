<?php
/**
 * User: mjyoon
 */

session_start();
$_SESSION['type'] = "logs";
$name = $_SESSION['name'];
if($name === null){
    http_response_code(403);
    header('Location: http://104.131.199.129:83/error/forbidden403.html');
    exit();
}

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

function connectDB (){
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'userinfo');
    define('DB_USER','root');
    define('DB_PASSWORD','ohanajumba');

    $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error() );
    $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error() );

}

function printUser($user, $status, $accesstime){

    echo "<tr>";
    print "<td> $user </td>";

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

function listUsers($usern)
{
    //Commence Query
    $queryUser = "SELECT * FROM useraccesslog WHERE master='$usern'";

    $result = mysql_query($queryUser);

    while ($row = mysql_fetch_array($result)) {
        printUser($row['email'], $row['accesstype'], $row['accesstime']);
    }

}

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
$username = htmlentities(substr(urldecode(gpc("user")), 0, 1024));

listUsers($username);
?>
