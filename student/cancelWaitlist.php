<?php
    session_start();
    if(!isset($_SESSION['Username'])) {
        header("location: index.php");
        exit();
    }
    ?><style><?php include 'style.css';?></style><?php
    echo "<a class='return-btn' href='viewCourse.php'>Return</a><br>";
    if (isset($_GET["courseID"])){
        $courseID = $_GET["courseID"];
        include("../database.php");
        $username = $_SESSION['Username'];

        $sql = "DELETE FROM waitlist WHERE username = ? AND courseID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
        echo "<section class='result-page-content'>";
        if(mysqli_stmt_execute($stmt)){
            echo "<h2>Success</h2>";
        } else {
            echo "<h2>Oops! Something go wrong...</h2>";
        }
        echo "</section>";
        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

?>