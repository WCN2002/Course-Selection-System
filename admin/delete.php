<?php
if (isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "course";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM course WHERE id=$id";
    $connection->query($sql);
}

header("location: /course/index.php");
exit;
?>
