<?php
    session_start();

    if(!isset($_SESSION['Username'])) {
        header("location: ../index.php");
        exit();
    }
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cusis";

$connection = new mysqli($servername, $username, $password, $database);
$pdo=new PDO('mysql:host=localhost;port=3306;dbname=cusis', $username, $password);

$courseID = "";
$courseName = "";
$location = "";
$department = "";
$professor = "";
$maxCapacity = "";
$day = "";
$time = "";
$outline = "";

$errorMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $courseID = $_POST["courseID"];
    $courseName = $_POST["courseName"];
    $location = $_POST["location"];
    $department = $_POST["department"];
    $professor = $_POST["professor"];
    $maxCapacity = $_POST["maxCapacity"];
    $day = $_POST["day"];
    $time = $_POST["time"];
    $outline = $_POST["outline"];

    do {
        if(empty($courseID) || empty($courseName) || empty($location) || empty($department) || empty($professor) || empty($maxCapacity) || empty($day)|| empty($time)|| empty($outline)){
            $errorMessage = "All the fields are required";
            break;
        }

        // check for duplicate courseID
        $ID = $_POST["courseID"];
        $sql = "SELECT * FROM courses WHERE courseID = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':zip' => $ID ));
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($row) > 0) {
          $errorMessage = "Course ID already exists";
          break;
        }

        if(!is_numeric($maxCapacity)){
            $errorMessage = "Capacity must be a number";
            break;
        }

        $sql = "INSERT INTO courses (courseID, courseName, location, department, professor, maxCapacity, remainSeat, day, time, outline)
                VALUES ('$courseID', '$courseName', '$location', '$department', '$professor', '$maxCapacity', '$maxCapacity', '$day', 'time', '$outline')";
        $result = $connection->query($sql);


        header("location: listCourses.php");
        exit;

    } while (false);
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
        <a class='btn btn-secondary btn-sm' href='listCourses.php'>Return</a>
        <br>
        <?php
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <br>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="courseID" value="<?php echo $courseID; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="courseName" value="<?php echo $courseName; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Place</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="location" value="<?php echo $location; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="department" value="<?php echo $department; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Instructor</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="professor" value="<?php echo $professor; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Maximum Class Capacity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="maxCapacity" value="<?php echo $maxCapacity; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Day</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="day" value="<?php echo $day; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Time</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="time" value="<?php echo $day; ?>">
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
