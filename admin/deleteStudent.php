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
Hello
</body>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "cusis";
  $pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', $username, $password);

// sqlite_changes
  $username = $_GET["username"];
  $sql = "SELECT * FROM enrolment WHERE username = :zip";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
      ':zip' => $username ));
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach($rows as $row) {
    $courseID = $row["courseID"];
    echo $courseID;
    $sql = "SELECT * FROM waitlist WHERE courseID = :zip AND waitlistID = (SELECT MIN(waitlistID) FROM waitlist WHERE courseID = :zip)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID));
        echo $courseID;
    $row_waitlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($row) > 0) {
      $studentToAdd = $row_waitlist[0]["username"];
      $sql = "INSERT INTO enrolment (courseID, username) VALUES (:courseID, :username)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
          ':courseID' => $courseID,
          ':username' => $studentToAdd));

      $sql = "DELETE FROM waitlist WHERE username = :username AND courseID = :courseID";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
          ':courseID' => $courseID,
          ':username' => $studentToAdd));
    }

    else {
      $sql = "UPDATE courses SET remainSeat = remainSeat + 1 WHERE courseID = :courseID";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
          ':courseID' => $courseID));
    }

  }
//change

  $username = $_GET["username"];
  $sql = "DELETE FROM users WHERE username = :zip";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
      ':zip' => $username));

    header("Location: seeStudents.php");
      exit;
?>
