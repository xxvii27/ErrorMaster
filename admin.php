<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 8/31/14
 * Time: 9:14 PM
 */
session_start();
$_SESSION['type'] = "admin";
$name = $_SESSION['name'];
if($name === null){
    http_response_code(403);
    header('Location: http://104.131.199.129:83/error/forbidden403.html');
    exit();
}
$date = date('m/d/Y h:i:s a', time());
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
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

function reloadUsers($username)
{


    $result = mysql_query("SELECT * FROM user WHERE email = '$username'");

    $row = mysql_fetch_array($result);

    $resource = mysql_query("SELECT COUNT(*) FROM errors WHERE master ='$username' ");
    $total_errors = mysql_result($resource,0);
    $resource = mysql_query("SELECT COUNT(DISTINCT name) FROM errors");
    $type_of_errors = mysql_result($resource,0);

    printOwner($username, $row['status'], $type_of_errors, $total_errors);

    //Commence Query
    $queryUser = "SELECT * FROM members WHERE master = '$username'";

    $result = mysql_query($queryUser);

    while ($row = mysql_fetch_array($result)) {
        printUser($row['email'], $row['status']);
    }

}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dash.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="js/admin.js"></script>

    <title>Error Master: Admin Mode</title>


</head>


<body>

<!-- Navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin.php">Error Master Admin Mode</a>
            <a class="navbar-brand" href="adaccesslog.php">User Access Log</a>
     </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                        <span id ="userid"><?php echo $name ?></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="./php/logout.php">Logout</a></li>
                    </ul>
                </li>
                <li style="color:white;"><?php echo $date ?></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <h1 class='page-header'>All Users</h1>
    <div class='btn-group pull-right'>
        <button type= 'button' class='btn btn-default' data-toggle='modal' data-target='.bs-example-modal-lg'><span class='glyphicon glyphicon-plus'></span></button>
    </div>
    <div class='dropdown pull-right'>
        <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown'>
            Sort By
            <span class='caret'></span>
        </button>
        <ul id='sort' class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>
            <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>User</a></li>
            <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Status</a></li>
            <li role='presentation'><a role='menuitem' tabindex='-1' href='#'># of Error Types</a></li>
            <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Total Errors</a></li>
        </ul>
    </div>
    <div class='table-responsive'>
        <table class='table table-striped'>
            <thead>
            <tr>
                <th>User</th>
                <th># of Error Types</th>
                <th>Total Errors</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody id='responseOutput'>
            <?php
                connectDB();
                reloadUsers("admin@errormaster.com");
            ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade bs-example-modal-lg" id="addUserDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="First Name" name="first" required>
                    <input type="text" class="form-control" placeholder="Last Name" name="last" required>
                    <input type="email" class="form-control" placeholder="Email" name="email" maxlength="31" required>
                    <input type="password" class="form-control" placeholder="Password" name="password" maxlength="31" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" type="submit" id="adduser">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-sm" id="editUserDialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="First Name" name="first" required>
                    <input type="text" class="form-control" placeholder="Last Name" name="last" required>
                    <input id="email"type="email" class="form-control" placeholder="Email" name="email" maxlength="31" required disabled>
                    <input type="password" class="form-control" placeholder="Password" name="password" maxlength="31" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" type="submit" id="edituser">Edit</button>
            </div>
        </div>
    </div>
</div>


</body>



</html>
