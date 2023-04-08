

<?php


$pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', 'fred', 'zap');




if ( isset($_POST['delete']) && isset($_POST['courseID']) ) {
    $sql = "DELETE FROM courses WHERE courseID = :zip";
    echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['courseID']));
}

if ( isset($_POST['SeeMore']) && isset($_POST['courseID']) ) {
    session_start();
    $_SESSION['courseID'] = $_POST['courseID'];
    header("Location: http://localhost/first/courseInfo.php");
}

if ( isset($_POST['editCourse']) && isset($_POST['courseID']) ) {
    session_start();
    $_SESSION['courseID'] = $_POST['courseID'];
    header("Location: http://localhost/first/editCourse.php");

}
if ( isset($_POST['enrolment']) && isset($_POST['courseID']) ) {
    session_start();
    $_SESSION['courseID'] = $_POST['courseID'];
    header("Location: http://localhost/first/studentsInCourse.php");
}

$stmt = $pdo->query("SELECT courseID, courseName FROM courses");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<html>
<head></head><body><table border="1">

  <a href="http://localhost/first/addNewCourse.php">
        <input type="submit" value="Add New Course"/>
      </a>

<?php

foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['courseID']);
    echo("</td><td>");
    echo($row['courseName']);

    echo("</td><td>");
    echo('<form method="post"><input type="hidden" ');
    echo('name="courseID" value="'.$row['courseID'].'">'."\n");
    echo('<input type="submit" value="Del" name="delete">');
    echo("\n</form>\n");

    echo("</td><td>");
    echo('<form method="post"><input type="hidden" ');
    echo('name="courseID" value="'.$row['courseID'].'">'."\n");
    echo('<input type="submit" value="See More" name="SeeMore">');
    echo("\n</form>\n");

    echo("</td><td>");
    echo('<form method="post"><input type="hidden" ');
    echo('name="courseID" value="'.$row['courseID'].'">'."\n");
    echo('<input type="submit" value="Edit Course" name="editCourse">');
    echo("\n</form>\n");

    echo("</td><td>");
    echo('<form method="post"><input type="hidden" ');
    echo('name="courseID" value="'.$row['courseID'].'">'."\n");
    echo('<input type="submit" value="Enrolments" name="enrolment">');
    echo("\n</form>\n");

    echo("</td></tr>\n");
}
?>
