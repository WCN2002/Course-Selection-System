/* This is the course browsing page for student. Students can search, view details, and enroll the courses */

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
        <div class="search-container">
            <form action="searchCourse.php" method="POST">
                <input type="text" name="Search" placeholder="Search Course">
                <input type="text" name="Search-Time" placeholder="Time">
                <input type="text" name="Search-Department" placeholder="Department">
                <button type="submit" name="Submit-search">Search</button>
            </form>
        </div>
        <div class="search-result">
            <table class="table">
                <?php
                    if (isset($_POST['Submit-search'])){
                        $Search = $_POST['Search'];
                        $SearchTime = $_POST['Search-Time'];
                        $SearchDep = $_POST['Search-Department'];
                        $Data = "%$Search%";
                        $sql = "SELECT * FROM courses WHERE (courseID LIKE '$Data' OR courseName LIKE '$Data' OR location LIKE '$Data' OR professor LIKE '$Data' OR day LIKE '$Data')";
                        if($SearchTime != ""){
                            $sql .= "AND time LIKE '%$SearchTime%'";
                        }
                        if($SearchDep != ""){
                            $sql .= "AND department LIKE '%$SearchTime%'";
                        }
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if(mysqli_num_rows($result)>0){
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
                                <th>Avaliable Seat</th>
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
                                    <td>".$row["remainSeat"]."/".$row["maxCapacity"]."</td>
                                    <td>
                                        <a href='courseDetail.php?searchPage=1&courseID=".$row["courseID"]."&outline=".$row["outline"]."'>Detail</a>
                                        <a href='enroll.php?courseID=".$row["courseID"]."&remainSeat=".$row["remainSeat"]."'>Enroll</a>
                                    </td>
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
                            <thead>
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
                                    <td>".$row["remainSeat"]."/".$row["maxCapacity"]."</td>
                                    <td>
                                        <a href='courseDetail.php?searchPage=1&courseID=".$row["courseID"]."&outline=".$row["outline"]."'>Detail</a>
                                        <a href='enroll.php?courseID=".$row["courseID"]."&remainSeat=".$row["remainSeat"]."'>Enroll</a>
                                    </td>
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
    </section>
    

</body>
</html>
