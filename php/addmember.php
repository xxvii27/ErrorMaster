<?php

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

function  insertUser($firstname, $lastname, $email, $password, $master){

    //Encryption for password
    $password = hash("sha512", $password);

    //MySQL query command
    if($master === "admin@errormaster.com")
        $command = "INSERT INTO user (id, firstname, lastname, email, password, status, master)
				VALUES (NULL, '$firstname','$lastname','$email','$password', 0)";
    else
        $command = "INSERT INTO members (id, firstname, lastname, email, password, status, master)
				VALUES (NULL, '$firstname','$lastname','$email','$password', 0, '$master')";


    mysql_query($command);
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

function reloadUsers($username)
{
    $result = mysql_query("SELECT * FROM user WHERE email = '$username'");
    
    $row = mysql_fetch_array($result);

    printOwner($username, $row['status']);

    //Commence Query
    if($username === "admin@errormaster.com")
        $queryUser = "SELECT * FROM user WHERE email <> '$username'";
    else
        $queryUser = "SELECT * FROM members WHERE master = '$username'";

    $result = mysql_query($queryUser);

    while ($row = mysql_fetch_array($result)) {
        printUser($row['email'], $row['status']);
    }

}

connectDB();

$firstname = htmlentities(substr(urldecode(gpc("firstname")),0,1024));
$lastname = htmlentities(substr(urldecode(gpc("lastname")),0,1024));
$email = htmlentities(substr(urldecode(gpc("email")),0,1024));
$password = htmlentities(substr(urldecode(gpc("password")),0,1024));
$master = htmlentities(substr(urldecode(gpc("user")),0,1024));

insertUser($firstname, $lastname, $email, $password, $master);

reloadUsers($master);





?>