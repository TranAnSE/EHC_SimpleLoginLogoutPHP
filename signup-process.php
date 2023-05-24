<?php
//Policy require for Signup Process
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords is not matching");
}

//Hash password via PASSWORD_DEFAULT algorithm for security
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/config/database.php"; //Including MySQL database

//Insert value to database
$sql = "INSERT INTO users (name, username, password_hash) 
        VALUES (?, ?, ?)";

// Create a prepared statement
$stmt = $mysqli->stmt_init();

//If prepare error => Show error
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

//Bind variable
$stmt->bind_param(
    "sss",
    $_POST["name"],
    $_POST["username"],
    $password_hash
);

//Show successful page if signup success
if ($stmt->execute()) {

    header("Location: signup-success");
    exit;
}
//If username duplicate => Show error
else {

    if ($mysqli->errno === 1062) {
        die("Username already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
