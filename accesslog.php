<?php
/**
 * User: mjyoon
 */

session_start();
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

function printUser($username, $status, $accesstime){

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

function listUsers()
{
    //Commence Query
    $queryUser = "SELECT * FROM useraccesslog";

    $result = mysql_query($queryUser);

    while ($row = mysql_fetch_array($result)) {
        printUser($row['email'], $row['accesstype'], $row['accesstime']);
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

    <title>Error Master: User Access Log</title>


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
            <a class="navbar-brand" href="accesslog.php">User Access Log</a>
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
    <h1 class='page-header'>Access Log</h1>
    <div class='dropdown pull-right'>
        <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown'>
            Sort By
            <span class='caret'></span>
        </button>
        <ul id='sort' class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>
            <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>User</a></li>
            <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Access Type</a></li>
            <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Timestamp</a></li>
        </ul>
    </div>
    <div class='table-responsive'>
        <table class='table table-striped'>
            <thead>
            <tr>
                <th>User</th>
                <th>Access Type</th>
                <th>Timestamp</th>
            </tr>
            </thead>
            <tbody id='responseOutput'>
            <?php
                connectDB();
                listUsers();
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>
