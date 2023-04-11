<?php
    session_start();
    echo "<a href='viewCourse.php'>Return</a><br>";
    if (isset($_GET["courseID"])){
        $courseID = $_GET["courseID"];
        include("database.php");
        $username = $_SESSION['Username'];
        $sql = "SELECT * FROM waitlist WHERE courseID = ? ORDER BY waitlistID ASC";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $courseID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $sql = "INSERT INTO enrolment (username, courseID) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "is", $row["username"], $courseID);
            mysqli_stmt_execute($stmt);
            $sql = "DELETE FROM waitlist WHERE username = ? AND courseID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "is", $row["username"], $courseID);
            mysqli_stmt_execute($stmt);
        } else{
            $sql = "UPDATE courses SET remainSeat = remainSeat + 1 WHERE courseID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $courseID);
            mysqli_stmt_execute($stmt);
        }
        $sql = "DELETE FROM enrolment WHERE username = ? AND courseID = ?";
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