<?php

$is_invalid = false; //Flag Variable

if ($_SERVER["REQUEST_METHOD"] === "POST") { //Checking form sent?
    
    $mysqli = require __DIR__ . "/database.php"; //Including MySQL database
    
    //Select users table from database then query
    $sql = sprintf("SELECT * FROM users
                    WHERE username = '%s'",
                   $mysqli->real_escape_string($_POST["username"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    //Validate username and password
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    //Flag Successful
    $is_invalid = true;
}
    //Just Simple UI
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2.1.1/out/water.min.css">
</head>
<body>
    
    <h1>Login</h1>
<!-- Respond Error if Username or Password incorrect -->
    <?php if ($is_invalid): ?>
        <em>Username or Password may be incorrect</em>
    <?php endif; ?>
    <!-- Simple form to be fill data to login -->
    <form method="post">
        <label for="username">Username</label>
        <input type="username" name="username" id="username"
               value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <!-- Submit Button -->
        <button>Log in</button>
        <!-- Additional line -->
        <p>Don't have an account? <a href="signup">Click here</a></p>
    </form>
    
</body>
</html>