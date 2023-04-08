
<?php
$pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', 'fred', 'zap');
session_start();
$courseID = $_SESSION['courseID'];

$sql = "SELECT * FROM courses WHERE courseID = :zip";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':zip' => $courseID));
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<a href="http://localhost/first/listCourses.php">
      <input type="submit" value="Go Back To Course List"/>
    </a>
<h1><? echo $courseID . " " . $row[0]['courseName'] ?> </h1>
<p>
  <b>Course Name: <b> <? echo $row[0]['courseName']?><br>
  <b>Location: </b> <? echo $row[0]['location']?><br>
  <b>Department: </b> <? echo $row[0]['department']?><br>
  <b>Professor: </b> <? echo $row[0]['professor']?><br>
  <b>Maximum Capacity: </b> <? echo $row[0]['maxCapacity']?><br>
  <b>Day and Time: </b> <? echo $row[0]['day'] ." ". $row[0]['time']?><br>
  <b>Course Outline: </b> <? echo $row[0]['outline']?><br>

</p>
