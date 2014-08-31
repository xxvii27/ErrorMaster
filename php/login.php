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

  if( (isset($_POST["username"])) || (isset($_POST["password"])) ) {
    $user = $_POST["username"];
    $pw = $_POST["password"];
    $access = $_POST["status"];
    // echo "got username and password";
  }
  else {
    /*$doc = new DomDocument();
    $doc->loadHTMLFile("invalidlogin.html");
    $tag = $doc->getElementsByTagName("h3").item(0);
    echo $tag;
    $newtag = $doc->createElement("h3", "Please provide a valid username and password");
    //$doc->replaceChild($tag, $newtag);
    $doc->appendChild($newtag);
    $doc->saveHTMLFile("invalidlogin.html");
    echo "Please provide a valid username and password";*/
    header("Location: http://104.131.199.129:83/invalidlogin.php");
    die();
    //return 0;
  }

  //Encryption for password
  $pw = hash("sha512", $pw);

  //Check with db
  //Query based on access status
  if($access == "owner"){
    $com_user = mysql_query("SELECT * FROM user WHERE email = '$user' and password = '$pw'");
    //Set user to online
    mysql_query("UPDATE user SET status=1 WHERE email = '$user' and password = '$pw'");
  }
  else{
    $com_user = mysql_query("SELECT * FROM members WHERE email = '$user' and password = '$pw'");
    mysql_query("UPDATE members SET status=1 WHERE email = '$user' and password = '$pw'");
  }


if( mysql_num_rows($com_user) == 0 ) {
    //echo "Invalid email or password";
    header("Location: http://104.131.199.129:83/invalidlogin.php");
    die();
  }

  
  $_SESSION['name']= $user;
  $_SESSION['access']= $access;
   
  session_write_close(); 
  
  header("Location: http://104.131.199.129:83/dash.php");
  die();

  /*date_default_timezone_set("America/Los_Angeles");
  $curTime = date("F j, Y, g:i a");
  $retString = array();

  $retString["name"] = $user;
  $retString["date"] = $curTime;

  echo json_encode($retString);*/
?>
