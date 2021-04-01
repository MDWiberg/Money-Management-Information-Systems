<?php

$host = "localhost";
$dbUser = "mdwiberg";
$dbPassword = "cs480";
$dbName = "mdwiberg";

$connect = mysqli_connect($host, $dbUser, $dbPassword, $dbName);

if(!$connect){
   die("Connection to database failed: ".mysqli_connect_error());
}

?>