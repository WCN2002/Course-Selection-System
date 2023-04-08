<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
</head>
<body>
    <div class="login-card">
        <h2>Login</h2>
        <form action="check.php" class="login-form" method="POST">
            <input type="text" name="Username" placeholder= "Username" required><br>
            <input type="password" name="Password" placeholder="Password" required><br>
            <input type="submit" name="Login" value="Login"><br>
            <?php
                if(isset($_SESSION["error"])){
                    $error = $_SESSION["error"];
                    echo "<span>$error</span>";
                }
            ?>  
        </form>
    </div>
</body>
</html>

<?php
    unset($_SESSION["error"]);
?>