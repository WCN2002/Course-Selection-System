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
    <h1>Admin</h1>
    <br>
    <a class='btn btn-secondary btn-sm' href='http://localhost/admin/addCourse.php'>Add New Course</a>
    <a class='btn btn-secondary btn-sm' href='http://localhost/admin/seeStudents.php'>See Student Users</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Instructor</th>
                <th>Capacity</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $servername = "localhost";
            $username = "fred";
            $password = "zap";
            $database = "cusis";

            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error){
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM courses ORDER BY courseID ASC";
            if($result = $connection->query($sql)){
            while ($row = $result->fetch_assoc()){
                echo "<tr>
                    <td>" . $row["courseID"] . "</td>
                    <td>" . $row["courseName"] . "</td>
                    <td>" . $row["professor"] . "</td>
                    <td>" . $row["maxCapacity"] . "</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/admin/edit.php?courseID=$row[courseID]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/admin/deleteCourse.php?courseID=$row[courseID]'>Delete</a>
                        <a class='btn btn-success btn-sm' href='/admin/info.php?courseID=$row[courseID]'>See Info</a>
                    </td>
                </tr>";
            }}

            ?>
        </tbody>
    </table>
</body>
</html>
