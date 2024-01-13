<?php

    include("session-start.php");
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
            $sql2="insert into appointment(pacient_id,appointment_number,schedule_id,appointment_date) values ($userid,$appointment_number,$schedule_id,'$date')";
            $result= $database->query($sql2);
           
            header("location: appointment.php?action=booking-added&id=".$appointment_number."&titleget=none");

        }
    }
 ?>