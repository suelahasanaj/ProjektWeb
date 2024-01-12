<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Sektori i Pacientëve</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php
    include("session_start.php");
    include("../connection.php");
    ?>
    <div class="container">
    <?php 
        include("menu.html");
        ?>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="patient.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Kthehu</font></button></a>
                        
                    </td>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Kërko pacientin me emër ose email" list="patient">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="patient">';
                                $list11 = $database->query("select  patient_name,patient_email from patient;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["patient_name"];
                                    $c=$row00["patient_email"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
?> 
                       
                            <input type="Submit" value="Kërko" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Data e sotme
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Europe/Tirane');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Të gjithë pacientët (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from patient where patient_email='$keyword' or patient_name='$keyword' or patient_name like '$keyword%' or patient_name like '%$keyword' or patient_name like '%$keyword%' ";
                    }else{
                        $sqlmain= "select * from patient order by patient_id desc";

                    }
                ?>
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                Emri
                                
                                </th>
                                <th class="table-headin">
                                    
                                
                                    Numri I Identifikimit Personal(NIC)
                                    
                                </th>
                                <th class="table-headin">
                                
                            
                                Numri i telefonit
                                
                                </th>
                                <th class="table-headin">
                                    Email
                                </th>
                                <th class="table-headin">
                                    
                                    Data e lindjes
                                    
                                </th>
                                <th class="table-headin">
                                    
                                    Evente
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nuk gjetëm asgjë në lidhje me kërkimin tuaj!</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Shfaqi të gjithë pacientët &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $patient_id=$row["patient_id"];
                                    $name=$row["patient_name"];
                                    $email=$row["patient_email"];
                                    $nic=$row["patient_nic"];
                                    $dob=$row["patient_birthdate"];
                                    $tel=$row["patient_phonenumber"];
                                    
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($name,0,35)
                                        .'</td>
                                        <td>
                                        '.substr($nic,0,12).'
                                        </td>
                                        <td>
                                            '.substr($tel,0,10).'
                                        </td>
                                        <td>
                                        '.substr($email,0,20).'
                                         </td>
                                        <td>
                                        '.substr($dob,0,10).'
                                        </td>
                                        <td >
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id='.$patient_id.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Shiko</font></button></a>
                                       
                                        </div>
                                        </td>
                                    </tr>';
                                    
                                }
                            }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    <?php 
    if($_GET){
        
        $id=$_GET["id"];
        $action=$_GET["action"];
            $sqlmain= "select * from patient where patient_id='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["patient_name"];
            $email=$row["patient_email"];
            $nic=$row["patient_nic"];
            $dob=$row["patient_birthdate"];
            $tele=$row["patient_phonenumber"];
            $address=$row["patient_address"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Shiko detajet.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">ID e pacientit: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    P-'.$id.'<br><br>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Emri: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Numri I Identifikimit Personal(NIC): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$nic.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Numri i telefonit: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$tele.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Adresa: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            '.$address.'<br><br>
                            </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Data e lindjes: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$dob.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="patient.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        
    };

?>
</div>
<?php
include("../footer.html")
?>
</body>
</html>