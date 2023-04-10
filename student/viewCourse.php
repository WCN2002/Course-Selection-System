<?php
    session_start();

    if(!isset($_SESSION['Username'])) {
        header("location: index.php");
        exit();
    }
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['Username']; ?></h1>
    <h2><a href = "searchCourse.php">Search Course</a></h2>
    <h2><a href = "logout.php">Sign Out</a></h2>
    <div class="search-result">
        <h2>Enrolled Courses</h2>
        <table class="table">
            <?php
                $username = $_SESSION['Username'];
                $sql = "SELECT * FROM courses C, enrolment E WHERE E.courseID = C.courseID AND E.username = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result)){
                    echo '
                    <thread>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Place</th>
                        <th>Department</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Instructor</th>
                        <th>Drop Course</th>
                    </tr>
                    </thread>
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
                                <a href='dropCourse.php?courseID=".$row["courseID"]."'>Drop</a>
                            <td>
                        </tr>
                        </tbody>
                        ";
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_free_result($result);
                } else{
                    echo '<h2>No course found</h2>';
                    mysqli_stmt_close($stmt);
                    mysqli_free_result($result);
                }
                
            
            ?>
            

        </table>
    </div>

</body>
</html>