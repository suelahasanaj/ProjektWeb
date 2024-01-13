<?php
    session_start();
    
    if($_GET){
        include("../connection.php");
        $id=$_GET["id"];
        $sql= $database->query("delete from schedule where schedule_id='$id';");
        $usertype = $_SESSION['usertype'];
        if ($usertype=="a"){
            $location = "../admin/schedule.php";
        }
        elseif($usertype == "d" ){
            $location = "../doctor/schedule.php";
        }
        header("location: {$location}");
    }
?>