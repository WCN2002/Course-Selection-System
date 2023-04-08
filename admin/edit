<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "course";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$outline = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET' ){
    if ( !isset($_GET["id"])){
        header("location: /course/index.php");
        exit;
    }
    $id = $_GET["id"];
    $sql = "SELECT * FROM course WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    if (!$row){
        header("location: /course/index.php");
        exit;
    }
    $outline = $row["outline"];
}
else{
    $id = $_GET["id"];
    $outline = $_POST["outline"];

    do {
        $sql = "UPDATE course SET id=$id, outline='$outline' WHERE id=$id";
        $result = $connection->query($sql);

        if (!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        header("location: /course/index.php");
        exit;
    } while(false);
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
        <form method="post">
            <input type="hidden" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Outline</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="outline" value="<?php echo $outline; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
