<?php


  session_start();


  $gPW = "opensesame";
  if( (isset($_POST["username"])) || (isset($_POST["password"])) ) {
    $user = $_POST["username"];
    $pw = $_POST["password"];
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
    header("Location: http://104.131.199.129:82/invalidlogin.php");
    die();
    //return 0;
  }

  if( strcmp($pw, $gPW) != 0 ) {
    //echo "Invalid email or password";
    header("Location: http://104.131.199.129:82/invalidlogin.php");
    die();
  }

  date_default_timezone_set('America/Los_Angeles');
  $time = date_default_timezone_get();

  $_SESSION['name'] = $user;
   
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
