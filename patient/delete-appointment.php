<?php

    // session_start();

    // if(isset($_SESSION["user"])){
    //     if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
    //         header("location: ../login.php");
    //     }

    // }else{
    //     header("location: ../login.php");
    // }
    
    
    // if($_GET){
       
    //     include("../connection.php");
    //     $id=$_GET["id"];
    //     //$result001= $database->query("select * from schedule where schedule_id=$id;");
    //     //$email=($result001->fetch_assoc())["doctor_email"];
    //     $sql= $database->query("delete from appointment where appointment_id='$id';");
    //     $stmt = $database->prepare($sqlmain);
    //     $stmt->bind_param("i",$id);
    //     $stmt->execute();
    //     //$sql= $database->query("delete from doctor where doctor_email='$email';");
    //     //print_r($email);
    //     header("location: appointment.php");
    // }

    session_start();

if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}

if ($_GET) {
    include("../connection.php");
    $id = $_GET["id"];
    
    // Use a parameterized query to avoid SQL injection
    $sql = "DELETE FROM appointment WHERE appointment_id = ?";
    
    // Prepare and execute the query
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    
    // Redirect after deletion
    header("location: appointment.php");
}


?>