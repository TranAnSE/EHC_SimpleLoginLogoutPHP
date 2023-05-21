<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>

<html>
    <head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2.1.1/out/water.min.css">
    </head>
    <body>
        <h1>Home</h1>
        <?php if (isset($user)): ?>
        
        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
        
        <p><a href="logout">Log out</a></p>
        
    <?php else: ?>
        
        <p><a href="login">Log in</a> or <a href="signup">sign up</a></p>
        
    <?php endif; ?>
    
</body>
</html>