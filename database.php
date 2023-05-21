<?php
//Connect to MySQL Database

$host = "localhost";
$dbname = "loginout";
$username = "loginout";
$password = "5SkZSarhkLacF2sC";

$mysqli = new mysqli($host, $username, $password, $dbname);
                     
//Checking Connection
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
};

return $mysqli;
