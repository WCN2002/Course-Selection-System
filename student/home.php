<?php
    session_start();
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['Username']; ?></h1>
    <h2><a href = "logout.php">Sign Out</a></h2>
    <div class="search-container">
        <form action="home.php" method="POST">
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
                    $sql = "SELECT * FROM course WHERE cID LIKE ? OR cName LIKE ? OR Place LIKE ? OR Department LIKE ? OR Instructor LIKE ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "sssss", $Data, $Data, $Data, $Data, $Data);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_array($result);
                    
                    mysqli_stmt_close($stmt);
                    mysqli_free_result($result);

                    if(is_array($row)){
                        echo '
                        <thread>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Place</th>
                            <th>Department</th>
                            <th>Instructor</th>
                        </tr>
                        </thread>
                        ';
                        echo '
                        <tbody>
                        <tr>
                            <td>'.$row['cID'].'</td>
                            <td>'.$row['cName'].'</td>
                            <td>'.$row['Place'].'</td>
                            <td>'.$row['Department'].'</td>
                            <td>'.$row['Instructor'].'</td>
                        </tr>
                        </tbody>
                        ';
                    } else{
                        echo '<h2>No course found</h2>';
                    }
                }
            
            ?>
            

        </table>
    </div>

</body>
</html>