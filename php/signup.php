<?php

//Database Connection 
function connectDB (){
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'userinfo');
    define('DB_USER','root');
    define('DB_PASSWORD','ohanajumba');

    $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
    $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

}



//Getting information from post
function  insertUser(){

    $firstname = mysql_real_escape_string($_POST["first"]);
    $lastname = mysql_real_escape_string($_POST["last"]);
    $email = mysql_real_escape_string($_POST["email"]);
    $password = mysql_real_escape_string($_POST["password"]);
    $code = mysql_real_escape_string($_POST['code']);

    //Encryption for password
    $password = hash("sha512", $password);


    //MySQL query command
    $command = "INSERT INTO user (id, firstname, lastname, email, password, code, status)
				VALUES (NULL, '$firstname','$lastname','$email','$password',$code ,0)";

    $query = mysql_query($command) or die( mysql_error() );

    if($query){
        header("Location: http://104.131.199.129:83/signed.html");
    }
}


//signup
function sign(){

    $email = mysql_real_escape_string($_POST["email"]);
    //check duplicates
    $command = mysql_query("SELECT * FROM user WHERE email = '$email'") or die( mysql_error() );
    $row = mysql_fetch_array($command) or die( mysql_error() );
    echo $row;
    if( !$row ) {
        insertUser();
    }
    else {

        header("Location: http://104.131.199.129:83/alreadyexist.html");

    }


}

if(isset($_POST['submit']))
{

    connectDB();
    //sign user
    sign();
}


?>