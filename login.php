<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
        
    <title>Hyr në llogari:</title>

</head>
<body>
    <?php

    session_start();

    $_SESSION["user"]="";
    $_SESSION["usertype"]="";
    

    date_default_timezone_set('Europe/Tirane');
    $date = date('Y-m-d');

    $_SESSION["date"]=$date;
    
    include("connection.php");


    if($_POST){

        $email=$_POST['useremail'];
        $password=$_POST['userpassword'];
        
        $error='<label for="promter" class="form-label"></label>';

        $result= $database->query("select * from webuser where email='$email'");
        if($result->num_rows==1){
            $utype=$result->fetch_assoc()['usertype'];
            if ($utype=='p'){
                
                $checker = $database->query("select * from patient where patient_email='$email' and patient_password='$password'");
                if ($checker->num_rows==1){


                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='p';
                    
                    header('location: patient/index.php');

                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Të dhënat e gabuara: Email-i ose fjalëkalimi nuk përputhet!</label>';
                }

            }elseif($utype=='a'){
               
                $checker = $database->query("select * from admin where admin_email='$email' and admin_password='$password'");
                if ($checker->num_rows==1){

                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='a';
                    
                    header('location: admin/index.php');

                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Të dhënat e gabuara: Email-i ose fjalëkalimi nuk përputhet!</label>';
                }


            }elseif($utype=='d'){
                
                $checker = $database->query("select * from doctor where doctor_email='$email' and doctor_password='$password'");
                if ($checker->num_rows==1){


                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='d';
                    header('location: doctor/index.php');

                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Të dhënat e gabuara: Email-i ose fjalëkalimi nuk përputhet!</label>';
                }

            }
            
        }else{
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Nuk mund të gjejmë asnjë llogari për këtë email.</label>';
        }






        
    }else{
        $error='<label for="promter" class="form-label">&nbsp;</label>';
    }

    ?>





    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Mirëseerdhët sërish!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Logohu me detajet e tua për të vazhduar.</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useremail" class="form-label">Email-i: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="Adresa e Email-it" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Fjalëkalimi: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="Password" name="userpassword" class="input-text" placeholder="Vendos Fjalëkalimin" required>
                </td>
            </tr>


            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Hyr" class="login-btn btn-primary btn">
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Nuk ke një llogari&#63; </label>
                    <a href="signup.php" class="hover-link1 non-style-link">Regjistrohu.</a>
                    <br><br><br>
                </td>
            </tr>
                        
                        
    
                        
                    </form>
        </table>

    </div>
</center>
</body>
</html>