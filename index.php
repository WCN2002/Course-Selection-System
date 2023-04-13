<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8FF;
        }
        .login-card {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #B0C4DE;
            border-radius: 10px;
            text-align: center;
        }
        .login-card h2 {
            margin-top: 0;
            color: #5F9EA0;
        }
        .login-form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }
        .login-form input {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid gray;
            border-radius: 5px;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 93%;
        }
        .login-form input[type="submit"] {
            background-color: #5F9EA0;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            padding: 10px;
        }
        .error-message {
            color: #a94442;
            background-color: #f2dede;
            border: 1px solid #a94442;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Login</h2>
        <form action="check.php" class="login-form" method="POST">
            <input type="text" name="Username" autocomplete="off" placeholder= "Username" required><br>
            <input type="password" name="Password" autocomplete="off" placeholder="Password" required><br>
            <input type="submit" name="Login" value="Login"><br>
            <?php
                // if the username or password is invalid, error message will be shown 
                if(isset($_SESSION["error"])){
                    $error = $_SESSION["error"];
                    echo "<span>$error</span>";
                }
            ?>
        <p>Don't have an account? <a href="loginregister.php">Register one!</a></p>
        </form>
    </div>
</body>
</html>

<?php
    unset($_SESSION["error"]);
?>
