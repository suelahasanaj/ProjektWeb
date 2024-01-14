<!DOCTYPE html>
<html lang="en">
<?php
    include("header.html");
?>
<body>
<?php
    include("session_start.php");
    include("../connection.php"); // lidhja me databaze

    if($_POST){
        $result= $database->query("select * from webuser"); // kontrollojme nese emaili ekziston ne databaze
        $name=$_POST['name'];
        $nic=$_POST['nic'];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        
        if ($password==$cpassword){ // kontrollojme nese passwordi eshte i njejte me konfirmimin e passwordit
            $error='3';
            $result= $database->query("select * from webuser where email='$email';");
            if($result->num_rows==1){
                $error='1';
            }else{
                $sql1="insert into doctor(doctor_email,doctor_name,doctor_password,doctor_nic,doctor_phonenumber,specialty) values('$email','$name','$password','$nic','$tele',$spec);";
                $sql2="insert into webuser values('$email','d')";
                $database->query($sql1);
                $database->query($sql2);

                $error= '4';
                
            }
        }else{
            $error='2';
        } 
    }else{
        $error='3';
    }
    header("location: doctors.php?action=add&error=".$error);
    ?>
</body>
</html>