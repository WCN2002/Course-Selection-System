<?php
    session_start();
    if(!isset($_SESSION['Username'])) {
        header("location: index.php");
        exit();
    }
    $lastPage = "viewCourse.php";
    if (isset($_GET["searchPage"]))
    {
        if($_GET["searchPage"] == 1){
            $lastPage = "searchCourse.php";
        }
    }

    echo "<a href='".$lastPage."'>Return</a><br>";
    if (isset($_GET["courseID"]) && isset($_GET["courseID"])){
        $courseID = $_GET["courseID"];
        $outline = $_GET["outline"];
        echo "<h2>".$courseID."</h2>";
        echo "<p>".$outline."</p>";
    }
?>