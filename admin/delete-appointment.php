<?php
    include("session_start.php");
    
    if($_GET){
        include("../connection.php");
        $id=$_GET["id"];
        $sql= $database->query("delete from appointment where appointment_id='$id';");
        header("location: appointment.php");
    }
?>