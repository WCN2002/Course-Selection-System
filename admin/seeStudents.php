/* PAGE FOR SEEING ALL STUDENTS AND THEIR INFORMATION */

<?php
    session_start();

    if(!isset($_SESSION['Username'])) {
        header("location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body style="margin: 50px;">
    <h1>Student Users</h1>
    <br>
    <a class='btn btn-secondary btn-sm' href='listCourses.php'>Return</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            
           // LOGIN TO DATABASE AND ESTABLISH CONNECTION
          <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "cusis";

            $connection = new mysqli($servername, $username, $password, $database);
            $pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', $username, $password);

            if ($connection->connect_error){
                die("Connection failed: " . $connection->connect_error);
            }
        
            // GET ALL STUDENT ENTRIES IN ASCENDING ORDER
            $sql = "SELECT * FROM users WHERE isAdmin=0 ORDER BY username ASC";
            if($result = $connection->query($sql)){
                
                // DISPLAY STUDENT ENTRIES IN TABLE FORMAT
            while ($row = $result->fetch_assoc()){
                echo "<tr>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["firstName"] . "</td>
                    <td>" . $row["lastName"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>
                        <a class='btn btn-danger btn-sm' href='deleteStudent.php?username=$row[username]'>Delete</a>
                    </td>
                </tr>";
            }}

            ?>
        </tbody>
    </table>
</body>
</html>
