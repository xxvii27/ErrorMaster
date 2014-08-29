<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- le styles -->
    <link href="/css/bootstrap_login.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="/js/bootstrap.min.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons (can edit these later) -->
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Error Master</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="http://104.131.199.129:81/">About</a></li>
              <li><a href="http://104.131.199.129:81/">Contact</a></li>
            </ul>
          <div>
          <form class="navbar-form pull-right" id="login" action="/php/login.php" method="POST" accept-charset="UTF-8">
              <input class="span2" type="email" placeholder="Email" id="username" name = "username" maxlength="30" />
              <input class="span2" type="password" placeholder="Password" id="password" name = "password" maxlength="30" />
              <button type="submit" class="btn">Sign in</button>
            </form></div>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>ErrorMaster the Error Collector</h1>
        <p> Collect Client side errors, using this simple and easy tool</p>
      </div>

      <div class="sign-up">
	      <form class="form-signin" action="./php/signup.php" role="form" method="POST">
	        <h2 class="form-signin-heading">Sign Up</h2>
	        <input type="text" class="form-control" placeholder="First Name"  name='first' required autofocus>
	        <input type="text" class="form-control" placeholder="Last Name"  name='last' required autofocus>
	        <input type="email" class="form-control" placeholder="Email address" name='email' required autofocus>
	        <input type="password" class="form-control" placeholder="Password" name='password' required>
	        <button class="btn btn-primary btn-large sign-up-button" name='submit' type="submit">Sign Me Up!</button>
	      </form>
    	</div> <!-- /container -->

      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">
          <h2>Team Management</h2>
          <p>Add your team members, to discuss errors !!!!</p>
          <img src="images/user.png" alt='user'>
          <img src="images/erro.png" alt='error'>
          <img>
        </div>
        <div class="span4">
          <h2>Easy to Use</h2>
          <p>Just Copy our script to your page, and we will begin collecting for you</p>
       </div>
        <div class="span4">
          <h2>Powerful Data Display</h2>
          <p>Experience the rich statistics about particular erros happening in your site</p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Bozos 2013</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--script src="/js/jquery.js"></script-->
    <script src="/js/bootstrap-transition.js"></script>
    <script src="/js/bootstrap-alert.js"></script>
    <script src="/js/bootstrap-modal.js"></script>
    <script src="/js/bootstrap-dropdown.js"></script>
    <script src="/js/bootstrap-scrollspy.js"></script>
    <script src="/js/bootstrap-tab.js"></script>
    <script src="/js/bootstrap-tooltip.js"></script>
    <script src="/js/bootstrap-popover.js"></script>
    <script src="/js/bootstrap-button.js"></script>
    <script src="/js/bootstrap-collapse.js"></script>
    <script src="/js/bootstrap-carousel.js"></script>
    <script src="/js/bootstrap-typeahead.js"></script>

  </body>
</html>




<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="login_style.css">
<title>Login Page</title>
</head>

<body>
	<div class="logo" align="left">
		<img src="logo.jpg" alt="toothless logo">
	</div>

	<div class="graphic" align="left">
		<img src="graphic.png" alt="graphic">
	</div>

	<div class="center" id="container" align="right">
		<form name="input" action="" method="get">
			Email: <input type="text" name="email">
			Password: <input type="password" name="pwd">
			<input type="submit" value="Submit">
		</form>
	</div>

	<div class="body" align="right">
		<h1>This is some content</h1>
		<p>This is a paragraph</p><br>
		<p>This is a paragraph</p><br>
		<p>This is a paragraph</p><br>
		<p>This is a paragraph</p><br>
		<p>This is a paragraph</p><br>
		<p>This is a paragraph</p><br>
		<p>This is a paragraph</p><br>
		<p>This is a paragraph</p><br>
	</div>

</body>
</html> -->
