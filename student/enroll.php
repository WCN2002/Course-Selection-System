<?php
    session_start();
    echo "<a href='searchCourse.php'>Return</a><br>";
    if (isset($_GET["courseID"])){
        $courseID = $_GET["courseID"];
        include("database.php");
        $username = $_SESSION['Username'];

        $sql = "INSERT INTO enrolment (username, courseID) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $courseID);
        if(mysqli_stmt_execute($stmt)){
            echo "Success";
        } else {
            echo "Cannot enroll this course.";
        }
    
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        }

?>