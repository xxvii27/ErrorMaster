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

    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to mysqli: " . mysqli_error($con) );

    return $con;
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

function printUser($username, $status){

    echo "<tr>";
    print "<td>$username</td>";
    echo  "<td></td>";
    echo "<td></td>";
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

function reloadUsers($username, $db)
{


    $result = mysqli_query($db, "SELECT * FROM user WHERE email = '$username'");

    $row = mysqli_fetch_array($db, $result);

    $resource = mysqli_query($db, "SELECT COUNT(*) FROM errors WHERE master ='$username' ");
    $total_errors = mysqli_result($resource,0);
    $resource = mysqli_query($db, "SELECT COUNT(DISTINCT name) FROM errors WHERE master ='$username'");
    $type_of_errors = mysqli_result($resource,0);

    printOwner($username, $row['status'], $type_of_errors, $total_errors);

    //Commence Query
    $queryUser = "SELECT * FROM members WHERE master = '$username'";

    $result = mysqli_query($db, $queryUser);

    while ($row = mysqli_fetch_array($result)) {
        printUser($row['email'], $row['status']);
    }

}


function printUserAdmin($username, $status, $num_of_errors, $total_errors){

    echo "<tr>";
    print "<td> $username </td>";
    echo  "<td>$num_of_errors</td>";
    echo "<td>$total_errors</td>";
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


function printOwnerAdmin($username, $status){
    echo "<tr>";
    print "<td> $username </td>";
    echo  "<td></td>";
    echo "<td></td>";
    echo "<td>";

    if($status)
        echo "<span class='staton'>Online";
    else
        echo "<span class='statoff'>Offline";

    echo"</td>";
    echo"</tr>";
}

function reloadUsersAdmin($username, $db)
{


    $result = mysqli_query($db, "SELECT * FROM user WHERE email = '$username'");

    $row = mysqli_fetch_array($result);

    printOwnerAdmin($username, $row['status']);

    //Commence Query
    $queryUser = "SELECT * FROM user WHERE email <> '$username'";

    $result = mysqli_query($db, $queryUser);

    while ($row = mysqli_fetch_array($result)) {
        $email = $row['email'];
        $resource = mysqli_query($db, "SELECT COUNT(*) FROM errors WHERE master ='$email' ");
        $total_errors = mysqli_result($resource,0);
        $resource = mysqli_query($db, "SELECT COUNT(DISTINCT name) FROM errors WHERE master ='$email'");
        $type_of_errors = mysqli_result($resource,0);
        printUserAdmin($row['email'], $row['status'], $type_of_errors, $total_errors);
    }

}

function mysqli_result($res, $row, $field=0) {
    mysqli_data_seek($res, $row);
    $rows = mysqli_fetch_assoc($res);
    return $rows[$field];
}

$db = connectDB();

$username = mysqli_real_escape_string(htmlentities(substr(urldecode(gpc("username")), 0, 1024)), $db);
$master = mysqli_real_escape_string(htmlentities(substr(urldecode(gpc("master")), 0, 1024)), $db);

if($master === "admin@errormaster.com"){
    $command = "DELETE FROM user WHERE email = '$username'";
    mysqli_query($db, command) or die(mysqli_error($db));
    reloadUsersAdmin($master, $db);

}
else{
    $command = "DELETE FROM members WHERE email = '$username' AND master='$master'";
    mysqli_query($db, $command) or die(mysqli_error($db));
    reloadUsers($master, $db);
}


?>