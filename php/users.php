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

  connectDB();
  
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

$username = htmlentities(substr(urldecode(gpc("user")),0,1024));

//Commence Query





?>