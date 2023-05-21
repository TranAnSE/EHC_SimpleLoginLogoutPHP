<?php
//Initialize session data
session_start();
//Destroys all data registered in a session
session_destroy();
header('location:index.php');
?>