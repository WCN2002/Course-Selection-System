<?php
    $servername   = "localhost";
    $database = "project";
    $dbUsername = "root";
    $dbPassword = "";

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>
