<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='admin'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }

    if($_GET){
        include("../connection.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from doctor where doctor_id=$id;");
        $email=($result001->fetch_assoc())["doctor_email"];
        $sql= $database->query("delete from webuser where email='$email';");
        $sql= $database->query("delete from doctor where doctor_email='$email';");
        //print_r($email);
        header("location: doctors.php");
    }


?>