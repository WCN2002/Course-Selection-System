<?php
    session_start();
    if(!isset($_SESSION['Username'])) {
        header("location: ../index.php");
        exit();
    }
    ?><style><?php include 'style.css';?></style><?php
    echo "<a class='return-btn' href='searchCourse.php'>Return</a><br>";
    if (isset($_GET["courseID"])){
        $courseID = $_GET["courseID"];
        $remainSeat = $_GET["remainSeat"];
        include("../database.php");
        $username = $_SESSION['Username'];

        //check if user already enrolled to the course
        $sql = "SELECT * FROM enrolment WHERE username = ? AND courseID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        echo "<section class='result-page-content'>";
        if(mysqli_num_rows($result) == 0){
            // if user didn't enroll the course before
            if ($remainSeat > 0){
                // if there are avaliable seat, add enrolment directly
                $sql = "INSERT INTO enrolment (username, courseID) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
                if(mysqli_stmt_execute($stmt)){
                    echo "<h2>Success</h2>";
                    $sql = "UPDATE courses SET remainSeat = remainSeat - 1 WHERE courseID = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $courseID);
                    mysqli_stmt_execute($stmt);
                } else {
                    echo "<h2>You already enrolled the course!</h2>";
                }
                mysqli_stmt_close($stmt);
            } else{
                //if there is no avaliable seat
                //check if user is in the waitlist
                $sql = "SELECT * FROM waitlist WHERE username = ? AND courseID = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) == 0){
                    // if user isn't in the waitlist, add to the waitlist
                    $sql = "INSERT INTO waitlist (username, courseID) VALUES (?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
                    if(mysqli_stmt_execute($stmt)){
                        echo "<h2>Success! You are now on the waitlist</h2>";
                    }
                }else {
                    // if user is in the waitlist
                    echo "<h2>You are already in the waitlist!</h2>";
                }
                 
                mysqli_stmt_close($stmt);
            }
        } else{
            // if user enrolled the course before
            echo "<h2>You already enrolled the course!</h2>";
        }
        echo "</section>";

        mysqli_close($conn);
    }

?>