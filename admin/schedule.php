<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title_of_schedule>Skedulim</title_of_schedule>
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
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    include("../connection.php");
    ?>
    <div class="container">
    <?php 
        include("menu.html");
        ?>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Kthehu</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Menaxhim i skedulimeve</p>
                                           
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Data e sotme
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                        date_default_timezone_set('Europe/Tirane');

                        $today = date('Y-m-d');
                        echo $today;

                        $list110 = $database->query("select  * from  schedule;");

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Skedulo një sesion</div>
                        <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/icons/add.svg');">Shto një sesion</font></button>
                        </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Të gjithë sesionet (<?php echo $list110->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="10%">

                           </td> 
                        <td width="5%" style="text-align: center;">
                        Data:
                        </td>
                        <td width="30%">
                        <form action="" method="post">
                            
                            <input type="date" name="schedule_date" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        <td width="5%" style="text-align: center;">
                        Doktor:
                        </td>
                        <td width="30%">
                        <select name="doctor_id" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;" >
                            <option value="" disabled selected hidden>Zgjidh emrin e doktorit nga lista</option><br/>
                                
                            <?php 
                            
                                $list11 = $database->query("select  * from  doctor order by doctor_name asc;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $sn=$row00["doctor_name"];
                                    $id00=$row00["doctor_id"];
                                    echo "<option value=".$id00.">$sn</option><br/>";
                                };

                                ?>

                        </select>
                    </td>
                    <td width="12%">
                        <input type="submit"  name="filter" value=" Filtro" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                
                <?php
                    if($_POST){
                        //print_r($_POST);
                        $sqlpt1="";
                        if(!empty($_POST["schedule_date"])){
                            $schedule_date=$_POST["schedule_date"];
                            $sqlpt1=" schedule.schedule_date='$schedule_date' ";
                        }


                        $sqlpt2="";
                        if(!empty($_POST["doctor_id"])){
                            $doctor_id=$_POST["doctor_id"];
                            $sqlpt2=" doctor.doctor_id=$doctor_id ";
                        }
                        //echo $sqlpt2;
                        //echo $sqlpt1;
                        $sqlmain= "select schedule.schedule_id,schedule.title_of_schedule,doctor.doctor_name,schedule.schedule_date,schedule.schedule_time,schedule.number_of_patients from schedule inner join doctor on schedule.doctor_id=doctor.doctor_id ";
                        $sqllist=array($sqlpt1,$sqlpt2);
                        $sqlkeywords=array(" where "," and ");
                        $key2=0;
                        foreach($sqllist as $key){

                            if(!empty($key)){
                                $sqlmain.=$sqlkeywords[$key2].$key;
                                $key2++;
                            };
                        };
                        //echo $sqlmain;
                    }else{
                        $sqlmain= "select schedule.schedule_id,schedule.title_of_schedule,doctor.doctor_name,schedule.schedule_date,schedule.schedule_time,schedule.number_of_patients from schedule inner join doctor on schedule.doctor_id=doctor.doctor_id  order by schedule.schedule_date desc";

                    }
                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                Titulli i sesionit
                                
                                </th>
                                
                                <th class="table-headin">
                                    Doctor
                                </th>
                                <th class="table-headin">
                                    
                                Data dhe ora e sesionit
                                    
                                </th>
                                <th class="table-headin">
                                    
                                Numri maksimal i pacientëve për sesion
                                    
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
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nuk gjetëm asgjë në lidhje me kërkimin tuaj !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Shfaq të gjitha sesionet &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $schedule_id=$row["schedule_id"];
                                    $title_of_schedule=$row["title_of_schedule"];
                                    $doctor_name=$row["doctor_name"];
                                    $schedule_date=$row["schedule_date"];
                                    $schedule_time=$row["schedule_time"];
                                    $number_of_patients=$row["number_of_patients"];
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($title_of_schedule,0,30)
                                        .'</td>
                                        <td>
                                        '.substr($doctor_name,0,20).'
                                        </td>
                                        <td style="text-align:center;">
                                            '.substr($schedule_date,0,10).' '.substr($schedule_time,0,5).'
                                        </td>
                                        <td style="text-align:center;">
                                            '.$number_of_patients.'
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id='.$schedule_id.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Shiko</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id='.$schedule_id.'&name='.$title_of_schedule.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Fshij</font></button></a>
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
        if($action=='add-session'){

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                    
                        <a class="close" href="schedule.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">'.
                                   ""
                                
                                .'</td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Shto sesion të ri.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <form action="add-session.php" method="POST" class="add-new-form">
                                    <label for="title_of_schedule" class="form-label">Titulli i sesionit: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="title_of_schedule" class="input-text" placeholder="Emri i këtij sesioni" required><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="doctor_id" class="form-label">Zgjidh doktorin: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="doctor_id" id="" class="box" >
                                    <option value="" disabled selected hidden>Zgjidh emrin e doktorit nga lista</option><br/>';
                                        
        
                                        $list11 = $database->query("select  * from  doctor order by doctor_name asc;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $sn=$row00["doctor_name"];
                                            $id00=$row00["doctor_id"];
                                            echo "<option value=".$id00.">$sn</option><br/>";
                                        };
        
        
        
                                        
                        echo     '       </select><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="number_of_patients" class="form-label">Numri i pacientëve/Numri i takimeve : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="number" name="number_of_patients" class="input-text" min="0"  placeholder="Numri final i takimeve për këtë sesion varet nga ky numër" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="date" class="form-label">Data e sesionit: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="date" name="date" class="input-text" min="'.date('Y-m-d').'" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="time" class="form-label">Koda e skedulimit: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="time" name="time" class="input-text" placeholder="Koha" required><br>
                                </td>
                            </tr>
                           
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Rifillo" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Perfundo këtë sesion" class="login-btn btn-primary btn" name="shedulesubmit">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }elseif($action=='session-added'){
            $titleget=$_GET["title_of_schedule"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Sesioni i kryer.</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                        '.substr($titleget,0,40).' U skedulua.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='drop'){
            $nameget=$_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Je i sigurt?</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                            Dëshiron ta fshish këtë rekord<br>('.substr($nameget,0,40).').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-session.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Po&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;Jo&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            '; 
        }elseif($action=='view'){
            $sqlmain= "select schedule.schedule_id,schedule.title_of_schedule,doctor.doctor_name,schedule.schedule_date,schedule.schedule_time,schedule.number_of_patients from schedule inner join doctor on schedule.doctor_id=doctor.doctor_id  where  schedule.schedule_id=$id";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $doctor_name=$row["doctor_name"];
            $schedule_id=$row["schedule_id"];
            $title_of_schedule=$row["title_of_schedule"];
            $schedule_date=$row["schedule_date"];
            $schedule_time=$row["schedule_time"];
            
           
            $number_of_patients=$row['number_of_patients'];


            $sqlmain12= "select * from appointment inner join patient on patient.patient_id=appointment.pacient_id inner join schedule on schedule.schedule_id=appointment.schedule_id where schedule.schedule_id=$id;";
            $result12= $database->query($sqlmain12);
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="width: 70%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                            
                            
                        </div>
                        <div class="abc scroll" style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Shiko detajet.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Titulli i sesionit: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$title_of_schedule.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Doctor of this session: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$doctor_name.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Data e skeduluar: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$schedule_date.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Koha e skeduluar: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$schedule_time.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label"><b>Pacientë të regjistruar tashmë në këtë sesion:</b> ('.$result12->num_rows."/".$number_of_patients.')</label>
                                    <br><br>
                                </td>
                            </tr>

                            
                            <tr>
                            <td colspan="4">
                                <center>
                                 <div class="abc scroll">
                                 <table width="100%" class="sub-table scrolldown" border="0">
                                 <thead>
                                 <tr>   
                                        <th class="table-headin">
                                             ID e pacientit
                                         </th>
                                         <th class="table-headin">
                                             Emri i pacientit
                                         </th>
                                         <th class="table-headin">
                                             
                                                Numri i takimit
                                             
                                         </th>
                                        
                                         
                                         <th class="table-headin">
                                                Numri i telefonit të pacientit
                                         </th>
                                         
                                 </thead>
                                 <tbody>';
                                 
                
                
                                         
                                         $result= $database->query($sqlmain12);
                
                                         if($result->num_rows==0){
                                             echo '<tr>
                                             <td colspan="7">
                                             <br><br><br><br>
                                             <center>
                                             <img src="../img/notfound.svg" width="25%">
                                             
                                             <br>
                                             <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nuk gjetëm asgjë në lidhje me kërkimin tuaj !</p>
                                             <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Shfaq të gjitha takimet &nbsp;</font></button>
                                             </a>
                                             </center>
                                             <br><br><br><br>
                                             </td>
                                             </tr>';
                                             
                                         }
                                         else{
                                         for ( $x=0; $x<$result->num_rows;$x++){
                                             $row=$result->fetch_assoc();
                                             $appointment_number=$row["appointment_number"];
                                             $patient_id=$row["patient_id"];
                                             $patient_name=$row["patient_name"];
                                             $patient_phonenumber=$row["patient_phonenumber"];
                                             
                                             echo '<tr style="text-align:center;">
                                                <td>
                                                '.substr($patient_id,0,15).'
                                                </td>
                                                 <td style="font-weight:600;padding:25px">'.
                                                 
                                                 substr($patient_name,0,25)
                                                 .'</td >
                                                 <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                                 '.$appointment_number.'
                                                 
                                                 </td>
                                                 <td>
                                                 '.substr($patient_phonenumber,0,25).'
                                                 </td>
                                                 
                                                 
                
                                                 
                                             </tr>';
                                             
                                         }
                                     }
                                          
                                     
                
                                    echo '</tbody>
                
                                 </table>
                                 </div>
                                 </center>
                            </td> 
                         </tr>

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';  
    }
}
        
    ?>
    </div>

</body>
</html>