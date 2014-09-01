<?php
/**
 * Created by PhpStorm.
 * User: xxvii27
 * Date: 8/31/14
 * Time: 9:14 PM
 */
session_start();
$date = date('m/d/Y h:i:s a', time());
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
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                        <span id ="userid">Admin</span>
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
        </tbody>
    </table>
</div>


</body>



</html>