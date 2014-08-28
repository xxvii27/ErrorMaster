<?php

//Database Connection 
function connectDB (){
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'userinfo');
	define('DB_USER','root');
	define('DB_PASSWORD','ohanajumba');

	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); 
	mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

}



//Getting information from post
function  insertUser(){

	$firstname = $_POST["first"];
	$lastname =  $_POST["last"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	//MySQL query command 
	$command = "INSERT INTO user (id, firstname, lastname, email, password, status) 
				VALUES (NULL, '$firstname','$lastname','$email','$password', 0)";


           if( mysql_query($command) or die( mysql_error() ) ){
               header("Location: http://104.131.199.129:83/signed.html");
           }
}


//signup
function sign(){
   
    //check duplicates
    $command = mysql_query("SELECT * FROM user WHERE email = '$_POST[email]'") or die( mysql_error() );
    if( !$row = mysql_fetch_array($command) or die( mysql_error() ) ) { 
         insertUser(); 
    } 
    else { 

         header("Location: http://104.131.199.129:83/index.php");

    }

   
}

if(isset($_POST['submit']))
{
	
	connectDB();
	//sign user
	sign();
}


?>