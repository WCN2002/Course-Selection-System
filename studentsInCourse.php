<?php
$pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', 'fred', 'zap');
session_start();
$courseID = $_SESSION['courseID'];

if ( isset($_POST['delete']) && isset($_POST['username']) ) {
    $sql = "DELETE FROM enrolment WHERE courseID = :zip AND username = :username";
    echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':zip' => $courseID,
      ':username' => $_POST['username']));
}

$sql = "SELECT * FROM enrolment JOIN students USING (username) WHERE courseID = :zip";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':zip' => $courseID));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<head></head><body><table border="1">
<a href="http://localhost/first/listCourses.php">
      <input type="submit" value="Go Back To Course List"/>
    </a> <br><br>
<?php

foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['username']);
    echo("</td><td>");
    echo($row['firstName']);
    echo("</td><td>");
    echo($row['lastName']);

    echo("</td><td>");
    echo('<form method="post"><input type="hidden" ');
    echo('name="username" value="'.$row['username'].'">'."\n");
    echo('<input type="submit" value="Del" name="delete">');
    echo("\n</form>\n");

    echo("</td></tr>\n");
}
?>
