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

        header("Location: http://localhost/index.php");
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
        <h2>Add New Course</h2>
        <br>
        <form method="post">
            <input type="hidden" value="<?php echo $courseID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="courseID">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="courseName">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Place</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="location">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="department">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Instructor</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="professor">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Maximum Class Capacity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="maxCapacity">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Day</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="day">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Time</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="time">
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Outline</label>
                  <textarea class="form-control" id="outline" name= outline value="<?php echo $outline; ?>" rows="5"></textarea>
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
