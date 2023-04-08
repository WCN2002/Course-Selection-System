<?php
$pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', 'fred', 'zap');
session_start();
$courseID = $_SESSION['courseID'];

if ( isset($_POST['courseID'])) {
    $sql = "UPDATE courses SET courseID = :courseID WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':courseID' => $_POST['courseID']
      ));
}

if ( isset($_POST['courseName'])) {
    $sql = "UPDATE courses SET courseName = :courseName WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':courseName' => $_POST['courseName']
      ));
}

if ( isset($_POST['location'])) {
    $sql = "UPDATE courses SET Location = :location WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':location' => $_POST['location']
      ));
}

if ( isset($_POST['department'])) {
    $sql = "UPDATE courses SET department = :department WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':department' => $_POST['department']
      ));
}

if ( isset($_POST['professor'])) {
    $sql = "UPDATE courses SET professor = :professor WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':professor' => $_POST['professor']
      ));
}

if ( isset($_POST['maxCapacity'])) {
    $sql = "UPDATE courses SET maxCapacity = :maxCapacity WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':maxCapacity' => $_POST['maxCapacity']
      ));
}

if ( isset($_POST['day'])) {
    $sql = "UPDATE courses SET day = :day WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':day' => $_POST['day']
      ));
}

if ( isset($_POST['time'])) {
    $sql = "UPDATE courses SET time = :time WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':time' => $_POST['time']
      ));
}

if ( isset($_POST['courseOutline'])) {
    $sql = "UPDATE courses SET courseOutline = :courseOutline WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':courseOutline' => $_POST['courseOutline']
      ));
}

?>

<a href="http://localhost/first/listCourses.php">
      <input type="submit" value="Go Back To Course List"/>
    </a>

</table>
<h3>Edit Course <? echo $courseID ?> </h3>
<form method="post">
<p>Course ID:
<input type="text" name="courseID" size="40"></p>
<input type="submit" value="Update"/>
</form><br>

<form method="post">
<p>Course Name:
<input type="text" name="courseName"></p>
<input type="submit" value="Update"/>
</form><br>

<form method="post">
<p>Location:
<input type="text" name="location"></p>
<input type="submit" value="Update"/>
</form><br>

<form method="post">
<p><label for="department">Department:
  <select name="department" id="department">
    <option value="FINA">FINA</option>
    <option value="CSCI">CSCI</option>
    <option value="IERG">IERG</option>
    <option value="MATH">MATH</option>
    <option value="ELTU">ELTU</option>
  </select></p>
  <input type="submit" value="Update"/>
  </form><br>

<form method="post">
<p>Professor:
<input type="text" name="professor"></p>
<input type="submit" value="Update"/>
</form><br>

<form method="post">
<p>Max Capacity:
<input type="number" name="maxCapacity"></p>
<input type="submit" value="Update"/>
</form><br>

<form method="post">
<p><label for="day">Day:
  <select name="day" id="day">
    <option value="MON">MON</option>
    <option value="TUE">TUE</option>
    <option value="WED">WED</option>
    <option value="THU">THU</option>
    <option value="FRI">FRI</option>
    <option value="SAT">SAT</option>
  </select></p>
  <input type="submit" value="Update"/>
</form><br>

<form method="post">
<p>Time:
<input type="text" name="time"></p>
<input type="submit" value="Update"/>
</form><br>

<form method="post">
<p><label for="outline">Course Outline:<br/>
  <textarea rows="10" cols="40" id=outline" name="outline">
  </textarea></p>
  <input type="submit" value="Update"/>
  </form>

</body>
