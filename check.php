<?php
    include("database.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];
    }
    $sql = "SELECT * FROM users WHERE username = ? AND password = ? ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $Username, $Password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);
    
    mysqli_stmt_close($stmt);
    mysqli_free_result($result);

    $error = "Invalid username or password!";

    if(is_array($row)){
        $_SESSION["Username"] = $row['username'];
        $_SESSION["Password"] = $row['password'];
        if ($row['isAdmin']){
            header("Location:admin/listCourses.php");
        } else{
            header("Location:student/searchCourse.php");
        }
    } else{
        $_SESSION["error"] = $error;
        header("location: index.php");
    }
    
?>