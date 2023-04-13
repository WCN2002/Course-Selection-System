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
    $courseID = $_GET["courseID"];
    $sql = "SELECT * FROM courses WHERE courseID=$courseID";
    if($result = $connection->query($sql)) {
      $result = $connection->query($sql);
      $row = $result->fetch_assoc();
      if (!$row){
          header("Location: http://localhost/admin/listCourses.php");
          exit;
    }
    $outline = $row["outline"];
  }
}

if(isset($_POST['outline'])){
    $courseID = $_GET["courseID"];
    $outline = $_POST["outline"];
    $sql = "UPDATE courses SET outline = :outline WHERE courseID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $courseID,
        ':outline' => $_POST['outline']));
    header("Location: http://localhost/admin/listCourses.php");
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Edit</h2>
        <br>
        <a class='btn btn-secondary btn-sm' href='http://localhost/admin/listCourses.php'>Return</a>
        <br><br>
        <form method="post">
            <input type="hidden" value="<?php echo $courseID; ?>">
            <div class="row mb-3">
                <div class="form-group">
                  <label for="outline">Outline</label>
                  <textarea class="form-control" name='outline' id="outline" value="<?php echo $outline; ?>" rows="5"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-0 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
