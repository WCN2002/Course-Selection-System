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
    <h3>Welcome, <?php echo $_SESSION['Username']; ?></h3>
    <h3><a href = "viewCourse.php">View Course</a></h3>
    <h3><a href = "logout.php">Sign Out</a></h3>
    <div class="search-container">
        <form action="searchCourse.php" method="POST">
            <input type="text" name="Search" placeholder="Search Course">
            <button type="submit" name="Submit-search">Search</button>
        </form>
    </div>
    <div class="search-result">
        <table class="table">
            <?php
                if (isset($_POST['Submit-search'])){
                    $Search = $_POST['Search'];
                    $Data = "%$Search%";
                    $sql = "SELECT * FROM courses WHERE courseID LIKE ? OR courseName LIKE ? OR location LIKE ? OR department LIKE ? OR professor LIKE ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "sssss", $Data, $Data, $Data, $Data, $Data);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result)>0){
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
                            <th>Avaliable Seat</th>
                            <th>Action</th>
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
                                <td>".$row["remainSeat"]."/".$row["maxCapacity"]."</td>
                                <td>
                                    <a href='courseDetail.php?searchPage=1&courseID=".$row["courseID"]."&outline=".$row["outline"]."'>Detail</a>
                                    <a href='enroll.php?courseID=".$row["courseID"]."&remainSeat=".$row["remainSeat"]."'>Enroll</a>
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
                } else{
                    //show all course for the first time
                    $sql = "SELECT * FROM courses C ORDER BY C.courseID ASC";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result)>0){
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
                            <th>Avaliable Seat</th>
                            <th>Action</th>
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
                                <td>".$row["remainSeat"]."/".$row["maxCapacity"]."</td>
                                <td>
                                    <a href='courseDetail.php?searchPage=1&courseID=".$row["courseID"]."&outline=".$row["outline"]."'>Detail</a>
                                    <a href='enroll.php?courseID=".$row["courseID"]."&remainSeat=".$row["remainSeat"]."'>Enroll</a>
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
                }
            
            ?>
            

        </table>
    </div>

</body>
</html>