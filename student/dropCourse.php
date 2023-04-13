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
        include("database.php");
        $username = $_SESSION['Username'];
        // search if there is any student waiting for the dropped course
        // result sort in ascending order
        $sql = "SELECT * FROM waitlist WHERE courseID = ? ORDER BY waitlistID ASC";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $courseID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        echo "<section class='result-page-content'>";
        if (mysqli_num_rows($result) > 0){
            // there is student waiting for the dropped course
            // add the first student in waitlist to the course 
            $row = mysqli_fetch_assoc($result);
            $sql = "INSERT INTO enrolment (username, courseID) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "is", $row["username"], $courseID);
            mysqli_stmt_execute($stmt);
            // remove that student from the waitlist
            $sql = "DELETE FROM waitlist WHERE username = ? AND courseID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "is", $row["username"], $courseID);
            mysqli_stmt_execute($stmt);
        } else{
            // there is no student in the waitlist
            // increase the remaining seat by one
            $sql = "UPDATE courses SET remainSeat = remainSeat + 1 WHERE courseID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $courseID);
            mysqli_stmt_execute($stmt);
        }
        // Remove current user from the course 
        $sql = "DELETE FROM enrolment WHERE username = ? AND courseID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
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