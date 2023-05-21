<?php

if (empty($_POST["name"])) {
    die("Name is required");
}

if (preg_match("/([%\$#\*@]+)/", $_POST["name"])) {
    die("Your name may not contain a special character. Please try again.");
}

if (preg_match("/([%\$#\*@]+)/", $_POST["username"])) {
    die("Your username may not contain a special character. Please try again.");
}

if (strlen($_POST["username"]) < 5) {
    die("Username must be at least 5 characters");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords is not matching");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO users (name, username, password_hash)
        VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param(
    "sss",
    $_POST["name"],
    $_POST["username"],
    $password_hash
);

if ($stmt->execute()) {

    header("Location: signup-success");
    exit;
} else {

    if ($mysqli->errno === 1062) {
        die("username already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
