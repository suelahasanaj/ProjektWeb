<?php
   session_start();
    
    if($_GET){
        include("../connection.php");
        $id=$_GET["id"];
        $sql= $database->query("delete from appointment where appointment_id='$id';");
        $usertype = $_SESSION['usertype'];
        
        
        if ($usertype=="a"){
            $location = "../admin/appointment.php";
        }
        elseif($usertype == "d" ){
            $location = "../doctor/appointment.php";
        }
        else{
            $location = "../patient/appointment.php";
        }
        
        header("location: {$location}");

    }
?>