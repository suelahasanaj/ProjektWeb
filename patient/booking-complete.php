<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    include("../connection.php");
    $sqlmain= "select * from patient where patient_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["patient_id"];
    $username=$userfetch["patient_name"];


    if($_POST){
        if(isset($_POST["booknow"])){
            $appointment_number=$_POST["appointment_number"];
            $schedule_id=$_POST["schedule_id"];
            $date=$_POST["date"];
            $schedule_id=$_POST["schedule_id"];
            $sql2="insert into appointment(patient_id,appointment_number,schedule_id,appointment_date) values ($userid,$appointment_number,$schedule_id,'$date')";
            $result= $database->query($sql2);
           
            header("location: appointment.php?action=booking-added&id=".$appointment_number."&titleget=none");

        }
    }
 ?>