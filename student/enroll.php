<?php
    session_start();
    echo "<a href='searchCourse.php'>Return</a><br>";
    if (isset($_GET["courseID"])){
        $courseID = $_GET["courseID"];
        $remainSeat = $_GET["remainSeat"];
        include("database.php");
        $username = $_SESSION['Username'];
        if ($remainSeat > 0){
            // if there are avaliable seat
            $sql = "INSERT INTO enrolment (username, courseID) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
            if(mysqli_stmt_execute($stmt)){
                echo "Success";
                $sql = "UPDATE courses SET remainSeat = remainSeat - 1 WHERE courseID = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $courseID);
                mysqli_stmt_execute($stmt);
            } else {
                echo "You already enrolled the course!";
            }
            mysqli_stmt_close($stmt);
        } else{
            //if there is no avaliable seat
            //check if user already enrolled to the course
            $sql = "SELECT * FROM enrolment WHERE username = ? AND courseID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 0){
                // if user didn't enroll the course before
                //check if user is in the waitlist
                $sql = "SELECT * FROM waitlist WHERE username = ? AND courseID = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) == 0){
                    // if user isn't in the waitlist
                    $sql = "INSERT INTO waitlist (username, courseID) VALUES (?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "is", $username, $courseID);
                    if(mysqli_stmt_execute($stmt)){
                        echo "Success! You are now on the waitlist";
                    }
                }else {
                    // if user is in the waitlist
                    echo "You are already in the waitlist!";
                }
            } else{
                // if user enrolled the course before
                echo "You already enrolled the course!";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }

?>