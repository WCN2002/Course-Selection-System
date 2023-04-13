<?php
  $servername = "localhost";
  $username = "fred";
  $password = "zap";
  $database = "cusis";
  $pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', $username, $password);


  $courseID = $_GET["courseID"];
  $sql = "DELETE FROM courses WHERE courseID = :zip";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
      ':zip' => $courseID));

      header("Location: http://localhost/admin/listCourses.php");
      exit;
?>
