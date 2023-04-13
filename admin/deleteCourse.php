<?php
    session_start();

    if(!isset($_SESSION['Username'])) {
        header("location: ../index.php");
        exit();
    }
?>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "cusis";
  $pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', $username, $password);


  $courseID = $_GET["courseID"];
  $sql = "DELETE FROM courses WHERE courseID = :zip";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
      ':zip' => $courseID));

      header("Location: listCourses.php");
      exit;
?>
