<?php
    include("session_start.php");

    if($_GET){
        include("../connection.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from doctor where doctor_id=$id;");
        $email=($result001->fetch_assoc())["doctor_email"];
        $sql= $database->query("delete from webuser where email='$email';");
        $sql= $database->query("delete from doctor where doctor_email='$email';");
        header("location: doctors.php");
    }


?>