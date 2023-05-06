/* This is the student profile page which show the student enrolled courses and courses that the student is in the waitlist. */

<?php
    session_start();

    if(!isset($_SESSION['Username'])) {
        header("location: ../index.php");
        exit();
    }
    include("../database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h3 class="welcome-message">Welcome, <?php echo $_SESSION['Username']; ?></h3>
            <nav class="navigation">
                <a href = "searchCourse.php">Course Browsing</a>
                <a href = "viewCourse.php">Profile</a>
                <a class="btn-logout" href = "logout.php">Sign Out</a>
            </nav>
        </header>
    <section class="page-content">
        <div class="selectedCourse-result">
            <h2>Enrolled Courses</h2>
            <table class="table">
                <?php
                    $username = $_SESSION['Username'];
                    $sql = "SELECT * FROM courses C, enrolment E WHERE E.courseID = C.courseID AND E.username = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $username);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result)){
                        echo '
                        <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Place</th>
                            <th>Department</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Instructor</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        ';
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "
                            <tbody>
                            <tr>
                                <td>".$row["courseID"]."</td>
                                <td>".$row["courseName"]."</td>
                                <td>".$row["location"]."</td>
                                <td>".$row["department"]."</td>
                                <td>".$row["day"]."</td>
                                <td>".$row["time"]."</td>
                                <td>".$row["professor"]."</td>
                                <td>
                                    <a href='courseDetail.php?searchPage=0&courseID=".$row["courseID"]."&outline=".$row["outline"]."'>Detail</a>
                                    <a href='dropCourse.php?courseID=".$row["courseID"]."'>Drop</a>
                                </td>
                            </tr>
                            </tbody>
                            ";
                        }
                    } else{
                        echo '<h2>No course found</h2>';
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_free_result($result);
                ?>
            </table>
        </div>

        <div class="waitlist-result">
            <h2>Waitlist</h2>
            <table class="table">
                <?php
                    $username = $_SESSION['Username'];
                    $sql = "SELECT * FROM courses C, waitlist W WHERE W.courseID = C.courseID AND W.username = ?; ";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $username);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result)){
                        echo '
                        <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Place</th>
                            <th>Department</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Instructor</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        ';
                        while ($row = mysqli_fetch_assoc($result)){
                            $sql = "SELECT COUNT(*) AS position FROM waitlist WHERE courseID = ? AND  waitlistID <= (";
                            $sql .= "SELECT waitlistID FROM waitlist WHERE courseID = ? AND username = ?);";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "ssi", $row["courseID"], $row["courseID"], $username);
                            mysqli_stmt_execute($stmt);
                            $posResult = mysqli_stmt_get_result($stmt);
                            $position = mysqli_fetch_assoc($posResult);
                            echo "
                            <tbody>
                            <tr>
                                <td>".$row["courseID"]."</td>
                                <td>".$row["courseName"]."</td>
                                <td>".$row["location"]."</td>
                                <td>".$row["department"]."</td>
                                <td>".$row["day"]."</td>
                                <td>".$row["time"]."</td>
                                <td>".$row["professor"]."</td>
                                <td>".$position["position"]."</td>
                                <td>
                                <a href='courseDetail.php?searchPage=0&courseID=".$row["courseID"]."&outline=".$row["outline"]."'>Detail</a>
                                    <a href='cancelWaitlist.php?courseID=".$row["courseID"]."'>Cancel</a>
                                </td>
                            </tr>
                            </tbody>
                            ";
                        }
                        mysqli_free_result($posResult);
                    } else{
                        echo '<h2>No course found</h2>';
                    }

                    mysqli_stmt_close($stmt);
                    mysqli_free_result($result);
                ?>
            </table>
        </div>
    </section>
</body>
</html>
