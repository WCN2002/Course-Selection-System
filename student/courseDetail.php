<?php
    session_start();
    if(!isset($_SESSION['Username'])) {
        header("location: index.php");
        exit();
    }
    ?><style><?php include 'style.css';?></style><?php
    $lastPage = "viewCourse.php";
    if (isset($_GET["searchPage"]))
    {
        if($_GET["searchPage"] == 1){
            $lastPage = "searchCourse.php";
        }
    }

    echo "<a class='return-btn' href='".$lastPage."'>Return</a><br>";
    if (isset($_GET["courseID"]) && isset($_GET["courseID"])){
        $courseID = $_GET["courseID"];
        $outline = $_GET["outline"];
        echo "<section class='result-page-content'>";
        echo "<h2>".$courseID."</h2><br>";
        echo "<p>".$outline."</p>";
        echo "</section>";
    }
?>