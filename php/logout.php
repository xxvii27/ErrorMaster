<?php

session_start();
session_destroy();

header("Location: http://104.131.199.129:83/logout.html");

?>