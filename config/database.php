<?php
//Connect to MySQL Database

$host = "localhost";
$dbname = "loginout";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);
                     
//Checking Connection
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
};

return $mysqli;
