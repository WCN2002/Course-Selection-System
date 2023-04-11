<?php
    session_start();
    if(!isset($_SESSION['Username'])) {
        header("location: index.php");
        exit();
    }
    echo "<a href='viewCourse.php'>Return</a><br>";
    if (isset($_GET["courseID"])){
        $courseID = $_GET["courseID"];
        include("database.php");
        $username = $_SESSION['Username'];

        $sql = "DELETE FROM waitlist WHERE username = ? AND courseID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
        if(mysqli_stmt_execute($stmt)){
            echo "Success";
        } else {
            echo "Oops! Something go wrong...";
        }
    
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

?>