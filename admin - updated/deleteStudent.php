<?php
  $servername = "localhost";
  $username = "fred";
  $password = "zap";
  $database = "cusis";
  $pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', $username, $password);


  $username = $_GET["username"];
  $sql = "DELETE FROM students WHERE username = :zip";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
      ':zip' => $username));

      header("Location: http://localhost/course/seeStudents.php");
      exit;
?>
