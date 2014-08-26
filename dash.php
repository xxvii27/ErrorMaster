<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
$date = date('m/d/Y h:i:s a', time());
$name = $_SESSION['name'];
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
    <script src="/js/dash.js"></script>


    <title>Error Master</title>


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
          <a class="navbar-brand" href="dash.php">Error Master</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                <?php echo $name ?>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#logout">Logout</a></li>
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>


  <div class="container-fluid">
      <div class="row">

        <!-- Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">
            <form class="sidebar-form">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
              <ul class="nav nav-sidebar">
                <li class="active"><a href="#"  id="summary">Summary</a></li>
                <li><a href="#" id="allerrors">All Errors</a></li>
                <li><a href="#" id="settings">Settings</a></li>
                <li><a href="#" id="users">Users</a></li>
              </ul>
	      <p>Logged In :
              <?php echo $date ?>
              </p>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="dashcontent">


        </div>

      </div>
  </div>

</body>

</html>
