<?php
session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){ // nese eshte shtypur butoni submit
        include("../connection.php");
        $title=$_POST["title_of_schedule"];
        $doctor_id=$_POST["doctor_id"];
        $number_of_patients=$_POST["number_of_patients"];
        $date=$_POST["date"];
        $time=$_POST["time"];
        $sql="insert into schedule (doctor_id,title_of_schedule,schedule_date,schedule_time,number_of_patients) values ($doctor_id,'$title','$date','$time',$number_of_patients);";
        $result= $database->query($sql);
        header("location: schedule.php?action=session-added&title=$title");
    }
?>