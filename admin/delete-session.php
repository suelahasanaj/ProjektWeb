<?php
    include("session_start.php");
    
    if($_GET){
        include("../connection.php");
        $id=$_GET["id"];
        //$result001= $database->query("select * from schedule where schedule_id=$id;");
        //$email=($result001->fetch_assoc())["doctor_email"];
        $sql= $database->query("delete from schedule where schedule_id='$id';");
        //$sql= $database->query("delete from doctor where doctor_email='$email';");
        //print_r($email);
        header("location: schedule.php");
    }
?>