<?php
$pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', 'fred', 'zap');


if ( isset($_POST['courseID']) && isset($_POST['courseName'])
     && isset($_POST['location']) && isset($_POST['department'])
     && isset($_POST['professor'])  && isset($_POST['maxCapacity'])
     && isset($_POST['day']) && isset($_POST['time'])
     && isset($_POST['outline'])) {
    $sql = "INSERT INTO courses (courseID, courseName, location, department, professor, maxCapacity, day, time, outline)
              VALUES (:courseID, :courseName, :location, :department, :professor, :maxCapacity, :day, :time, :outline)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':courseID' => $_POST['courseID'],
        ':courseName' => $_POST['courseName'],
        ':location' => $_POST['location'],
        ':department' => $_POST['department'],
        ':professor' => $_POST['professor'],
        ':maxCapacity' => $_POST['maxCapacity'],
        ':day' => $_POST['day'],
        ':time' => $_POST['time'],
        ':outline' => $_POST['outline']));
}

?>

<a href="http://localhost/first/listCourses.php">
      <input type="submit" value="Go Back To Course List"/>
    </a>

</table>
<h3>Add A New Course</h3>
<form method="post">
<p>Course ID:
<input type="text" name="courseID" size="40"></p>
<p>Course Name:
<input type="text" name="courseName"></p>
<p>Location:
<input type="text" name="location"></p>
<p><label for="department">Department:
  <select name="department" id="department">
    <option value="FINA">FINA</option>
    <option value="CSCI">CSCI</option>
    <option value="IERG">IERG</option>
    <option value="MATH">MATH</option>
    <option value="ELTU">ELTU</option>
  </select></p>
<p>Professor:
<input type="text" name="professor"></p>
<p>Max Capacity:
<input type="number" name="maxCapacity"></p>
<p><label for="day">Day:
  <select name="day" id="day">
    <option value="MON">MON</option>
    <option value="TUE">TUE</option>
    <option value="WED">WED</option>
    <option value="THU">THU</option>
    <option value="FRI">FRI</option>
    <option value="SAT">SAT</option>
  </select></p>
<p>Time:
<input type="text" name="time"></p>
<p><label for="outline">Course Outline:<br/>
  <textarea rows="10" cols="40" id=outline" name="outline">
Description of course
  </textarea></p>
<p><input type="submit" value="Add New"/></p>
</form>
</body>
