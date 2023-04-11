<?php
$servername = "localhost";
$username = "fred";
$password = "zap";
$database = "cusis";

$connection = new mysqli($servername, $username, $password, $database);
$pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', $username, $password);


if ($_SERVER['REQUEST_METHOD'] == 'GET' ){
    if ( !isset($_GET["courseID"])){
        header("location: /admin/listCourses.php");
        exit;
    }
}

    $courseID = $_GET["courseID"];
    $sql = "SELECT * FROM courses WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID ));
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $courseID = $row[0]["courseID"];
      $courseName = $row[0]["courseName"];
      $location = $row[0]["location"];
      $department = $row[0]["department"];
      $professor = $row[0]["professor"];
      $maxCapacity = $row[0]["maxCapacity"];
      $remainSeat = $row[0]["remainSeat"];
      $day = $row[0]["day"];
      $time = $row[0]["time"];
      $outline = $row[0]["outline"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2> <?php echo $courseID; ?> | Course Information </h2>
        <div>
          <b>Course Name: <b> <? echo $courseName?><br>
          <b>Location: </b> <? echo $location?><br>
          <b>Department: </b> <? echo $department?><br>
          <b>Professor: </b> <? echo $professor?><br>
          <b>Maximum Capacity: </b> <? echo $maxCapacity?><br>
          <b>Seats Remaining: </b> <? echo $remainSeat?><br>
          <b>Day and Time: </b> <? echo $day ." ". $time?><br>
          <b>Course Outline: </b> <? echo $outline?><br>
        </div>
    </div>
</body>
</html>
