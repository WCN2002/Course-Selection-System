/* THIS ENABLES THE DELETE COURSE FEATURE FOR ADMIN USERS */

<?php
    session_start(); // START SESSION

    if(!isset($_SESSION['Username'])) {
        header("location: ../index.php");
        exit();
    }
?>

// LOGIN TO DATABASE
<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "cusis";
  $pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', $username, $password);


  $courseID = $_GET["courseID"]; //GET COURSEID THAT WILL BE DELETED

// DELETE COURSE FROM DATABASE
  $sql = "DELETE FROM courses WHERE courseID = :zip";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
      ':zip' => $courseID));

      header("Location: listCourses.php"); // RETURN TO MAIN PAGE
      exit;
?>
