<?php

session_start();
include("database.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Login Page</title>
</head>
<h1>Agent Login</h1>
<body>
    <form action="login.php" method="POST">
        <label>Username:</label><br />
        <input type="text" name="username" required/><br/><br/>
        
        <label>Password:</label><br />
        <input type="text" name="password" required/><br/><br/>

        <button type="submit">Login</button>
    </form>

    <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="error">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']); // Clear error after showing once
        }
    ?>

</body>
</html>
