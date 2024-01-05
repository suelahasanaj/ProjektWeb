
    <?php
    
   
    include("../connection.php");


    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $nic=$_POST['nic'];
        $oldemail=$_POST["oldemail"];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';

            $sqlmain= "select patient.patient_id from patient inner join webuser on patient.patient_email=webuser.email where webuser.email=?;";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result = $stmt->get_result();
            //$resultqq= $database->query("select * from doctor where doctor_id='$id';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["patient_id"];
            }else{
                $id2=$id;
            }
            

            if($id2!=$id){
                $error='1';
                //$resultqq1= $database->query("select * from doctor where doctor_email='$email';");
                //$did= $resultqq1->fetch_assoc()["doctor_id"];
                //if($resultqq1->num_rows==1){
                    
            }else{

                //$sql1="insert into doctor(doctor_email,doctor_name,doctor_password,doctor_nic,doctor_phonenumber,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
                $sql1="update patient set patient_email='$email',patient_name='$name',patient_password='$password',patient_nic='$nic',patient_phonenumber='$tele',patient_address='$address' where patient_id=$id ;";
                $database->query($sql1);
                echo $sql1;
                $sql1="update webuser set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
                echo $sql1;
                
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: settings.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>