<?php
session_start();

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


 $name = $_SESSION['name'];
 $access =  $_SESSION['access'];
 echo $name;

 if($access=="owner")
 {
     mysql_query("UPDATE user SET status=0 WHERE email='$name' ");
     // log successful logout
     mysql_query("INSERT INTO useraccesslog (email, accesstype, master) VALUES ('$name', 'LOGOUT', '$name')" );
 }
 else
 {
     mysql_query("UPDATE members SET status=0 WHERE email='$name' ");
     // log successful logout
     $qmaster = mysql_query("SELECT master FROM members WHERE email='$name'");
     if($qmaster) {
         $row = mysql_fetch_array($qmaster);
         $teamleader = $row['master'];
         mysql_query("INSERT INTO useraccesslog (email, accesstype, master) VALUES ('$name', 'LOGOUT', '$teamleader')" );
     }
 }
 session_destroy();

 header("Location: http://104.131.199.129:83/logout.html");

?>
