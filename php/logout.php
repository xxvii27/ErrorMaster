<?php
session_start();
$name = $_SESSION['name'];
echo $name;
mysql_query("UPDATE user SET status=0 WHERE email='llesmana@ucsd.edu' ");
session_destroy();

header("Location: http://104.131.199.129:83/logout.html");

?>