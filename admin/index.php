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
    <table class="table">
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Period</th>
                <th>Place</th>
                <th>Instructor</th>
                <th>Capacity</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "course";

            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error){
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM course";
            $result = $connection->query($sql);

            while ($row = $result->fetch_assoc()){
                echo "<tr>
                    <td>" . $row["course_id"] . "</td>
                    <td>" . $row["course_name"] . "</td>
                    <td>" . $row["period"] . "</td>
                    <td>" . $row["place"] . "</td>
                    <td>" . $row["instructor"] . "</td>
                    <td>" . $row["capacity"] . "</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/course/edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/course/delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>";
            }
            
            ?>
        </tbody>
    </table>
</body>
</html>
